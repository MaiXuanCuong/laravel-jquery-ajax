<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Services\Banner\BannerServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BannerController extends Controller
{
    protected $bannerService;
    function __construct(BannerServiceInterface $bannerService)
    {
        $this->bannerService = $bannerService;
    }
    public function index(Request $request)
    {
        return view('admin.banner.index');
    }
    public function getBanner(){
        $banners = $this->bannerService->all();
        if ($banners) {
            return response()->json([
                'banners' => $banners,
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'messeges' => 'Có lỗi xãy ra',
                'status' => 404,
            ]);
        }
    }
    public function store(Request $request)
    {
        $banner = $this->bannerService->create($request);
        if ($banner) {
            return response()->json([
                'banner' => $banner,
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'messeges' => 'Có lỗi xãy ra',
                'status' => 404,
            ]);
        }
    }
    public function update(Request $request, $id)
    {
        $banner = $this->bannerService->update($request, $id);
        if ($banner) {
            return response()->json([
                'banner' => $banner,
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'messeges' => 'Có lỗi xãy ra',
                'status' => 404,
            ]);
        }
    }
    public function updateStatus($id, $status)
    {
        try {
            $banner = Banner::findOrFail($id);
            if($status==1){
                $banner->status = 0;
                $banner->save();
                $banner = Banner::find($banner->id);
                return response()->json([
                    'banner' => $banner,
                    'status' => 200,
                    'message' => 'success',
                ]);
            }else{
                $banner->status = 1;
                $banner->save();
                $banner = Banner::find($banner->id);
                return response()->json([
                    'banner' => $banner,
                    'status' => 200,
                    'message' => 'success',
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return response()->json([
                'status' => 400,
                'message' => 'err',
            ]);
        }
        

    }
    public function destroy($id)
    {
        $banner = $this->bannerService->delete($id);
        if ($banner) {
            return response()->json([
                'banner' => $banner,
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'messeges' => 'Có lỗi xãy ra',
                'status' => 404,
            ]);
        }
    }
}