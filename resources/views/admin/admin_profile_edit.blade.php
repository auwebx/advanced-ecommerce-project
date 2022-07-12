@extends('admin.admin_master')
 @section('admin')
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 
 <div class="container-full">

    <section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Edit Admin Profile</h4>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{route('store.profile')}}" enctype="multipart/form-data"  novalidate="">
                        @csrf
					  <div class="row">
						<div class="col-12">			
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Admin Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" value="{{$profileData->name}}" class="form-control" required=""/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Admin Email <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="email" name="email" value="{{$profileData->email}}" class="form-control" required=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Profile Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="profile_photo_path" id="image" class="form-control" required=""> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img src="{{(!empty($profileData->profile_photo_path)) ? url('upload/admin_images/'.$profileData->profile_photo_path):url('upload/no_image.jpg')}}" alt="User Avatar" style="width: 100px; height:100px;" id="showImage" />
                                </div>
                            </div>
							
							
							<div class="form-group">
								<h5>Password Input Field <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="password" name="password" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
							</div>
							<div class="form-group">
								<h5>Repeat Password Input Field <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="password" name="password2" data-validation-match-match="password" class="form-control" required=""> <div class="help-block"></div></div>
							</div>
							
							
							<div class="form-group">
								<h5>Textarea <span class="text-danger">*</span></h5>
								<div class="controls">
									<textarea name="textarea" id="textarea" class="form-control" required="" placeholder="Textarea text"></textarea>
								<div class="help-block"></div></div>
							</div>
						</div>
					  </div>
						
						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info" value="Update"/>
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
		
 </div>

 <script type="text/javascript">
     $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
     });
 </script>



 @endsection