<div class="modal fade" id="event-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
	<form id="form-create-event" action="" method="get">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header justify-content-center">
					<h5 class="modal-title" id="event-modal-title"></h5>
				</div>
				<div class="modal-body">
					<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon1">Event Name:</span>
						<input type="text" class="form-control" id="InputEventName" name="title" required>
					</div>
					<div class="input-group mb-3">
						<label for="InputDescription" class="col-3 input-group-text">Description:</label>
						<div class="col-9">
							<textarea class="form-control" id="InputDescription" name="subtitle"></textarea>
						</div>
					</div>

					<div class="input-group mb-3 justify-content-center">
						<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
							<input type="radio" class="btn-check" name="type" id="fire_checkbox" value="fire" required>
							<label class="btn btn-outline-primary" for="fire_checkbox">Fire</label>
							
							<input type="radio" class="btn-check" name="type" id="earthquake_checkbox" value="earthquake" required>
							<label class="btn btn-outline-primary" for="earthquake_checkbox">Earthquake</label>
							
							<input type="radio" class="btn-check" name="type" id="other_checkbox" value="" required checked>
							<label class="btn btn-outline-primary" for="other_checkbox">Other</label>
						</div>
					</div>
					<div id="map_form" class="w-100" style="height: 300px"></div>
					<input type="hidden" name="id" value="">
				</div>
				<div class="modal-footer justify-content-evenly">
					<button type="button" class="col-3 btn btn-danger" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="col-3 btn btn-success" id="create_btn">Create</button>
				</div>
			</div>
		</div>
	</form>
</div>