<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\UploadFiles;
use Illuminate\Http\Request;
use App\Models\UploadFileGroups;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
class uploadImageOrFileController extends Controller
{
    //

    function manageUploads($file, $savepath, $gid = "")
    {
        if ($gid == "" || $gid == null || $gid == 0) {
            $maxGroupid = UploadFileGroups::max('file_group_id');
            $file_group_id = $maxGroupid + 1;
        } else {
            $file_group_id = $gid;
        }
        $savepathgid = $savepath . '/' . $file_group_id;
        $original_filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        //        $size = $file->getClientSize();
        $name = rand(1111111, 9999999) . '.' . $extension;
        Storage::putFileAs($savepathgid, $file, $name);
        $uploadData['filename'] = $name;
        $uploadData['original_filename'] = $original_filename;
        $uploadData['filebasepath'] = $savepath;
        $uploadData['filepath'] = $savepathgid;
        $uploadData['upload_type'] = $extension;
        $uploadData['upload_size'] = '0';
        if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif" || $extension == "JPG" || $extension == "JPEG" || $extension == "PNG" || $extension == "GIF") {
            $uploadData['meme_type'] = "image";
        } else if ($extension == "mp4" || $extension == "webm") {
            $uploadData['meme_type'] = "video";
        } else {
            $uploadData['meme_type'] = "doc";
        }
        $upload = UploadFiles::create($uploadData);
        if ($upload) {
            if ($gid == "" || $gid == null) {
                $maxGroupid = UploadFileGroups::max('file_group_id');
                $gid = $maxGroupid + 1;
                $uploadgroupData['file_group_id'] = $gid;
                $uploadgroupData['file_id'] = $upload->id;
                $uploadgroups = UploadFileGroups::create($uploadgroupData);
            } else {
                $uploadgroupData['file_group_id'] = $file_group_id;
                $uploadgroupData['file_id'] = $upload->id;
                $uploadgroups = UploadFileGroups::create($uploadgroupData);
            }
        }
        if ($uploadgroups) {
            // return $uploadgroups->file_group_id; ---- original code
            return $uploadgroups->file_id;
        }
    }
    function displayFile($file_id)
    {
        $upload = UploadFiles::where('id', $file_id)->first();
        if (!$upload) {
            return response("Null Media File", 403);
        }

        $filePath = $upload->filepath . "/" . $upload->filename;

        if (!Storage::exists($filePath)) {
            if ($upload->meme_type == 'doc') {
                return abort(404);
            } else {
                return response('File Not Found', 403);
            }
        }

        if ($upload->upload_type == "jpg") {
            $type = 'image/jpeg';
        } else if ($upload->upload_type == "gif") {
            $type = 'image/gif';
        } else if ($upload->upload_type == "png") {
            $type = 'image/png';
        } else if ($upload->upload_type == "PNG") {
            $type = 'image/png';
        } else if ($upload->upload_type == "pdf") {
            $type = 'application/pdf';
        } else if ($upload->upload_type == "doc") {
            $type = 'application/msword';
        } else if ($upload->upload_type == "docx") {
            $type = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
        } else if ($upload->upload_type == "ppt") {
            $type = "application/vnd.ms-powerpoint";
        } else if ($upload->upload_type == "pptx") {
            $type = "application/vnd.openxmlformats-officedocument.presentationml.presentation";
        } else if ($upload->upload_type == "mp4") {
            $type = "video/mp4";
        } else if ($upload->upload_type == "webm") {
            $type = "video/webm";
        } else {
            $type = 'image/jpeg';
        }

        header('Content-Type:' . $type);
        return readfile(Storage::path($filePath));
    }
    function displayFileForMobile($file_id)
    {
        $upload = UploadFiles::where('id', $file_id)->first();
        if (!$upload) {
            return response("Null Media File", 403);
        }

        $filePath = $upload->filepath . "/" . $upload->filename;

        if (!Storage::exists($filePath)) {
            if ($upload->meme_type == 'doc') {
                return abort(404);
            } else {
                return response('File Not Found', 403);
            }
        }

        if ($upload->upload_type == "jpg") {
            $type = 'image/jpeg';
        } else if ($upload->upload_type == "gif") {
            $type = 'image/gif';
        } else if ($upload->upload_type == "png") {
            $type = 'image/png';
        } else if ($upload->upload_type == "PNG") {
            $type = 'image/png';
        } else if ($upload->upload_type == "pdf") {
            $type = 'application/pdf';
        } else if ($upload->upload_type == "doc") {
            $type = 'application/msword';
        } else if ($upload->upload_type == "docx") {
            $type = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
        } else if ($upload->upload_type == "ppt") {
            $type = "application/vnd.ms-powerpoint";
        } else if ($upload->upload_type == "pptx") {
            $type = "application/vnd.openxmlformats-officedocument.presentationml.presentation";
        } else if ($upload->upload_type == "mp4") {
            $type = "video/mp4";
        } else if ($upload->upload_type == "webm") {
            $type = "video/webm";
        } else {
            $type = 'image/jpeg';
        }

        $file = Storage::get($filePath);
                return new Response($file, 200, [
                    'Content-Type' => $type]);
    }

    
    function downloadFile($file_id)
    {
        $upload = UploadFiles::where('id', $file_id)->first();
        if (!$upload) {
            return response("Null Media File", 403);
        }

        $filePath = $upload->filepath . "/" . $upload->filename;

        if (!Storage::exists($filePath)) {
            if ($upload->meme_type == 'doc') {
                return abort(404);
            } else {
                return response('File Not Found', 403);
            }
        }

        if ($upload->upload_type == "jpg") {
            $type = 'image/jpeg';
        } else if ($upload->upload_type == "gif") {
            $type = 'image/gif';
        } else if ($upload->upload_type == "png") {
            $type = 'image/png';
        } else if ($upload->upload_type == "PNG") {
            $type = 'image/png';
        } else if ($upload->upload_type == "pdf") {
            $type = 'application/pdf';
        } else if ($upload->upload_type == "doc") {
            $type = 'application/msword';
        } else if ($upload->upload_type == "docx") {
            $type = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
        } else if ($upload->upload_type == "ppt") {
            $type = "application/vnd.ms-powerpoint";
        } else if ($upload->upload_type == "pptx") {
            $type = "application/vnd.openxmlformats-officedocument.presentationml.presentation";
        } else if ($upload->upload_type == "mp4") {
            $type = "video/mp4";
        } else if ($upload->upload_type == "webm") {
            $type = "video/webm";
        } else {
            $type = 'image/jpeg';
        }

        header('Content-Type:' . $type);
        return response()->download(storage_path("app/{$filePath}"));
    }
    function getFileAccess($file_id)
    {
        $upload = UploadFiles::find($file_id);
        $hash_id = md5($file_id);
        $current_time = Carbon::now()->toDateTimeString();
        $upload->hash_id = $hash_id;
        $upload->created_at = $current_time;
        if ($upload->save()) {
            return $upload->hash_id;
        }
    }
    function getFile($groupId)
    {
        return UploadFileGroups::where('upload_file_groups.file_group_id', $groupId)
            ->leftJoin('upload_file', 'upload_file.id', 'upload_file_groups.file_id')
            ->select('upload_file.*')
            ->orderBy('id', 'desc')
            ->first();
    }

    function getImageFile($groupId)
    {
        return $data = UploadFileGroups::where('upload_file_groups.file_group_id', $groupId)
            ->join('upload_file', 'upload_file.id', 'upload_file_groups.file_id')
            ->select('upload_file.*')
            ->where('upload_file.meme_type', 'image')
            ->orderBy('upload_file.id', 'desc')
            ->first();
    }

    function getAllFiles($groupId)
    {
        return $data = UploadFileGroups::where('upload_file_groups.file_group_id', $groupId)
            ->join('upload_file', 'upload_file.id', 'upload_file_groups.file_id')
            ->select('upload_file.*')
            ->orderBy('upload_file.id', 'desc')
            ->get();
    }

    public function deleteFile($id)
    {
        $file = UploadFiles::where('id', $id)->first();
        if ($file) {
            $filelocation = $file->filepath;
            $filename = $file->filename;
            $filePath = $filelocation . '/' . $filename;
            $filepathfull = Storage::path($filePath);
            if (Storage::exists($filePath)) {
                unlink($filepathfull);
                UploadFileGroups::where('file_id', $id)->delete();
                UploadFiles::where('id', $id)->delete();
                return 'Deleted Successfully';
            }
        } else {
            return 'File Doesnot Exists';
        }
    }
}
