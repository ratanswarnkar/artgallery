<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artist;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtistController extends Controller
{
    // Constructor: apply your admin middleware if any
    

    public function index()
    {
        $artists = Artist::orderBy('created_at','desc')->paginate(20);
        return view('admin.artists.index', compact('artists'));
    }

    public function create()
    {
        return view('admin.artists.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'username' => 'required|unique:artists,username',
            'email'=>'nullable|email|unique:artists,email',
            'phone'=>'nullable|string|max:50',
            'bio'=>'nullable|string',
            'photo'=>'nullable|image|max:2048', // 2MB
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/artists'), $filename);
            $data['photo'] = $filename;
        }

        $artist = Artist::create($data);

        return redirect()->route('admin.artists.index')->with('success','Artist created.');
    }

    public function edit(Artist $artist)
    {
        return view('admin.artists.edit', compact('artist'));
    }

   public function update(Request $request, Artist $artist)
{
    $data = $request->validate([
        'name'     => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:artists,username,' . $artist->id,
        'email'    => 'nullable|email|unique:artists,email,' . $artist->id,
        'phone'    => 'nullable|string|max:50',
        'bio'      => 'nullable|string',
        'photo'    => 'nullable|image|max:2048',
    ]);

    // Handle photo upload
    if ($request->hasFile('photo')) {
        // delete old
        if ($artist->photo && file_exists(public_path('uploads/artists/'.$artist->photo))) {
            @unlink(public_path('uploads/artists/'.$artist->photo));
        }

        $file = $request->file('photo');
        $filename = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/artists'), $filename);
        $data['photo'] = $filename;
    }

    // (Optional) If you want to keep slug in sync with username or name:
    // $data['slug'] = Str::slug($data['username'] ?? $data['name']);

    $artist->update($data);

    return redirect()
        ->route('admin.artists.index')
        ->with('success','Artist updated.');
}


    public function destroy(Artist $artist)
    {
        // delete photo file
        if ($artist->photo && file_exists(public_path('uploads/artists/'.$artist->photo))) {
            @unlink(public_path('uploads/artists/'.$artist->photo));
        }
        $artist->delete();
        return redirect()->route('admin.artists.index')->with('success','Artist deleted.');
    }

    // Block/unblock
    public function toggleStatus(Artist $artist)
    {
        $artist->status = $artist->status === 'active' ? 'blocked' : 'active';
        $artist->save();
        return redirect()->back()->with('success','Artist status updated.');
    }
}
