<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyewa;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index(Request $request)
    {
        // Get search query
        $search = $request->get('search');

        // Fetch tenants with pagination and search
        $query = Penyewa::query();

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('namapenyewa', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('telp', 'like', "%{$search}%");
            });
        }

        // Get paginated results (10 per page)
        $tenants = $query->orderBy('idpenyewa', 'desc')->paginate(10);

        if ($search) {
            $tenants->appends(['search' => $search]);
        }

        // Mark all displayed tenants as viewed (not new anymore)
        $displayedTenantIds = collect($tenants->items())->pluck('idpenyewa')->toArray();
        if (!empty($displayedTenantIds)) {
            Penyewa::whereIn('idpenyewa', $displayedTenantIds)
                ->where('penyewa_baru', true)
                ->update(['penyewa_baru' => false]);
        }

        // Count new tenants (after marking displayed ones as viewed)
        $newTenantsCount = Penyewa::where('penyewa_baru', true)->count();

        return view('admin.tenants.index', compact('tenants', 'search', 'newTenantsCount'));
    }

    public function show($idpenyewa)
    {
        $tenant = Penyewa::with(['sewa.kamar', 'sewa.villa'])->findOrFail($idpenyewa);

        // Mark tenant as viewed (not new anymore)
        if ($tenant->penyewa_baru) {
            $tenant->penyewa_baru = false;
            $tenant->save();
        }

        return view('admin.tenants.show', compact('tenant'));
    }

    public function destroy($idpenyewa)
    {
        $tenant = Penyewa::findOrFail($idpenyewa);
        $tenant->delete();

        return redirect()->route('admin.tenants.index')->with('success', 'Data penyewa berhasil dihapus.');
    }
}




