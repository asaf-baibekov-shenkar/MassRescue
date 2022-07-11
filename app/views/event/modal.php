<div class="modal fade" id="event-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
	<form id="form-create-event" action="" method="get">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header justify-content-center">
					<h5 class="modal-title" id="event-modal-title">Add Force</h5>
				</div>
				<div class="modal-body">
					<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon1">Force Name:</span>
						<input type="text" class="form-control" id="InputEventName" name="event_name" required>
					</div>
					<div class="input-group mb-3">
						<label for="InputDescription" class="col-3 input-group-text">Message:</label>
						<div class="col-9">
							<textarea class="form-control" id="InputDescription" name="event_description"></textarea>
						</div>
					</div>
					<iframe width="100%" height="300px" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Tel%20Aviv%20azrieli+(Mass%20Rescue)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
					</iframe>
				</div>
				<div class="modal-footer justify-content-evenly">
					<button type="button" class="col-3 btn btn-danger" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="col-3 btn btn-success" id="add_btn">Add</button>
				</div>
			</div>
		</div>
	</form>
</div>