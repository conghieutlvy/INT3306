@extends('layouts.app')

@section('content')
    <div id="wrap">
        <div class="container">
            <div class="row">
 			<form action="import" enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}
                <input type="file" name="filesTest" required="true">
                <br/>
                <input type="submit" value="Import">
            </form>
            
            
            <hr />
                 <form class="form-horizontal" action="import" method="POST" name="upload_csv" enctype="multipart/form-data">
                {{ csrf_field() }}
                        <!-- Form Name -->
                        <legend>Up File</legend>
 						
                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                            <div class="col-md-4">
                                <input type="file" name="fileTest" id="file" class="input-large">
                            </div>
                        </div>
 
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                            <div class="col-md-4">
                                <input type="submit" id="submit" name="Import" value="Import" class="btn btn-primary button-loading" data-loading-text="Loading..."></input>
                            </div>
                        </div>
                </form>
                
            </div>
        </div>
    </div>
@endsection