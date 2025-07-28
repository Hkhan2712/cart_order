<?php
namespace App\Http\Controllers\Api;

use App\Http\Requests\AddressRequest;
use App\Repositories\UserAddressRepo;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends ApiController
{
    public function __construct(
        protected UserAddressRepo $repo
    ) {}
    
    public function index() {
        $addresses = $this->repo->allByUser(Auth::id());

        return response()->json(
            [
                'message' => 'Fetch successfully',
                'data' => $addresses,
            ]
        );
    }
    public function store(AddressRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $address = $this->repo->create($data);

        return response()->json(['message' => 'Created', 'data' => $address]);
    }

    public function update(AddressRequest $request, $id)
    {
        $address = $this->repo->findByUser($id, Auth::id());
        if (!$address) return response()->json(['message' => 'Not found'], 404);

        $this->repo->update($id, $request->validated());

        return response()->json(['message' => 'Updated', 'data' => $address->refresh()]);
    }

    public function destroy($id)
    {
        return $this->repo->deleteByUser($id, Auth::id())
            ? response()->json(['message' => 'Deleted'])
            : response()->json(['message' => 'Not found'], 404);
    }

    public function setDefault($id)
    {
        return $this->repo->setDefault($id, Auth::id())
            ? response()->json(['message' => 'Set as default'])
            : response()->json(['message' => 'Failed to set default'], 400);
    }
}
