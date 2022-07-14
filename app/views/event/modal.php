<div class="modal fade" id="event-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
	<form id="form-create-force" action="" method="get">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header justify-content-center">
					<h5 class="modal-title" id="event-modal-title">Add Force</h5>
				</div>
				<div class="modal-body">
					<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon1">Force Name:</span>
						<input type="text" class="form-control" id="InputForceName" name="title" required>
					</div>
					<div class="input-group mb-3">
						<label for="InputDescription" class="col-3 input-group-text">Description:</label>
						<div class="col-9">
							<textarea class="form-control" id="InputDescription" name="subtitle"></textarea>
						</div>
					</div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon1">Force Location:</span>
						<input type="text" class="form-control" id="InputAddress" name="">
					</div>
					<div id="map_form" class="w-100" style="height: 300px"></div>
					<input type="hidden" name="event_id" value="">
					<input type="hidden" name="force_id" value="">
					<input type="hidden" name="latitude" value="">
					<input type="hidden" name="longitude" value="">
				</div>
				<div class="modal-footer justify-content-evenly">
					<button type="button" class="col-3 btn btn-danger" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="col-3 btn btn-success" id="submit_btn">Add</button>
				</div>
			</div>
		</div>
	</form>
</div>