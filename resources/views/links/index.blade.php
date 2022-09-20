@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Links
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    	Add link
					</button>

					<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  	<div class="modal-dialog" role="document">
					    	<div class="modal-content">
						      	<div class="modal-header">
						        	<h5 class="modal-title" id="exampleModalLabel">Add new link</h5>
						        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          		<span aria-hidden="true">&times;</span>
						        	</button>
						      	</div>
						      	<div class="modal-body">
						        	<form method="POST" action="links/create">
						        		@csrf
									  	<div class="form-group">
									    	<label for="exampleInputPassword1">link</label>
									    	<input type="text" name="site_url" class="form-control" id="exampleInputPassword1" placeholder="Link">
									  	</div>
								      	<div class="modal-footer">
									  		<button type="submit" class="btn btn-primary">Save</button>
								      	</div>
									</form>
						      	</div>
					    	</div>
					  	</div>
					</div>
                </div>

                <div class="card-body">
                	<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Site url</th>
								<th scope="col">Short url</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($user->links as $link)
								<tr>
									<th scope="row">{{$link->id}}</th>
	        						<td>{{$link->site_url}}</td>
	        						<td>{{$link->short_url}}</td>
						        	<td>

						        	</td>
								</tr>
                            @endForeach
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection