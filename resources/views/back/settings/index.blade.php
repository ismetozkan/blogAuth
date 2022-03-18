@extends('back.layouts.master')
@section('content')
@section('title','Settings')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><strong><i>Settings</i></strong>

        </h6>
    </div>
    <div class="card-body">
       <form method="POST" action="{{ route('update.settings') }}" enctype="multipart/form-data">
           @csrf
        <div class="row">
           <div class="col-md-6">
               <div class="form-group">
                   <label>Site Title</label>
                   <input type="text" name="title" required class="form-control" value="{{ $settings->title }}">
               </div>
           </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Site Status</label>
                    <select class="form-control" name="status">
                        <option @if($settings->status==1) selected @endif value="1">Active</option>
                        <option @if($settings->status==0) selected @endif value="0">Passive</option>
                    </select>
                </div>
            </div>
        </div>
           <div class="row">
               <div class="col-md-6">
                   <div class="form-group">
                       <label>Site Logo</label>
                       <input type="file" name="logo" class="form-control">
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="form-group">
                       <label>Site Favicon</label>
                       <input type="file" name="favicon" class="form-control">
                   </div>
               </div>
           </div>
           <div class="row">
               <div class="col-md-6">
                   <div class="form-group">
                       <label>Facebook</label>
                       <input type="text" name="facebook" class="form-control" value="{{ $settings->facebook }}">
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="form-group">
                       <label>Twitter</label>
                       <input type="text" name="twitter" class="form-control" value="{{ $settings->twitter }}">
                   </div>
               </div>
           </div>
           <div class="row">
               <div class="col-md-6">
                   <div class="form-group">
                       <label>GitHub</label>
                       <input type="text" name="github" class="form-control" value="{{ $settings->github }}">
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="form-group">
                       <label>LinkedIn</label>
                       <input type="text" name="linkedin" class="form-control" value="{{ $settings->linkedin }}">
                   </div>
               </div>
           </div>
           <div class="row">
               <div class="col-md-6">
                   <div class="form-group">
                       <label>Instagram</label>
                       <input type="text" name="instagram" class="form-control" value="{{ $settings->instagram }}">
                   </div>
               </div>
           </div>
            <div class="row">
                <div class="col-md-12">
                   <div class="form-group">
                       <button type="submit" class="btn btn-block btn-md btn-success">Update</button>
                   </div>
                </div>
            </div>
       </form>
    </div>
</div>
@endsection


