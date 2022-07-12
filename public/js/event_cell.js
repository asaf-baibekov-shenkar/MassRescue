class EventsCell {
	constructor(event, crud_state) {
		this.event = event;
		this.crud_state = crud_state
	}

	getType() {
		switch (this.event.type) {
			case "earthquake": return ICONS_PATH + 'event-type-icons/earthquake.svg';
			case "fire": return ICONS_PATH + 'event-type-icons/fire.svg';
			default: return ICONS_PATH + 'event-type-icons/unknown.svg';
		}
	}

	generateCell() {
		return `
			<div index="${this.event.event_id}" class="cell shadow-lg d-flex align-items-center justify-content-between bg-light p-3 border-bottom border-dark">
				<div class="d-flex align-items-center">
					<img src="${this.getType()}" alt="" width="60px" height="60px">
					<div class="h-100 d-flex flex-column justify-content-center ms-3">
						<span class="fs-4">
							${this.event.title}
						</span>
						<span>
							${this.event.subtitle}
						</span>
					</div>
				</div>
				<div class="d-flex align-items-center">
					<div class="h-100 d-flex flex-column me-3 align-items-center">
						<span>Coordinate</span>
						<span>
							${parseFloat(this.event.latitude).toFixed(5)}
						</span>
						<span>
							${parseFloat(this.event.longitude).toFixed(5)}
						</span>
					</div>
					<img src="${ICONS_PATH + 'location-icon.svg'}" alt="" width="18px" height="24px">
					<a class="btn_edit btn btn-light border border-1 border-dark p-0 ms-3 ${this.crud_state != crudEnum.update ? 'd-none' : 'd-flex'} justify-content-center align-items-center" style="height: 38px; width: 38px">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="black" xmlns="http://www.w3.org/2000/svg">
							<path d="M2 18.0672V21.4445C2 21.7556 2.24441 22 2.55548 22H5.93279C6.07721 22 6.22164 21.9445 6.32162 21.8334L18.4533 9.71282L14.2872 5.54673L2.16664 17.6673C2.05555 17.7784 2 17.9117 2 18.0672ZM21.675 6.49104C22.1083 6.05777 22.1083 5.35787 21.675 4.92459L19.0754 2.32495C18.6421 1.89168 17.9422 1.89168 17.509 2.32495L15.4759 4.35801L19.642 8.52409L21.675 6.49104Z"/>
						</svg>
					</a>
					<a class="btn_close btn btn-light border border-1 border-dark p-0 ms-3 ${this.crud_state != crudEnum.delete ? 'd-none' : 'd-flex'} justify-content-center align-items-center" style="height: 38px; width: 38px">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="black" xmlns="http://www.w3.org/2000/svg">
							<path d="M12 2C6.47 2 2 6.47 2 12C2 17.53 6.47 22 12 22C17.53 22 22 17.53 22 12C22 6.47 17.53 2 12 2ZM16.3 16.3C15.91 16.69 15.28 16.69 14.89 16.3L12 13.41L9.11 16.3C8.72 16.69 8.09 16.69 7.7 16.3C7.31 15.91 7.31 15.28 7.7 14.89L10.59 12L7.7 9.11C7.31 8.72 7.31 8.09 7.7 7.7C8.09 7.31 8.72 7.31 9.11 7.7L12 10.59L14.89 7.7C15.28 7.31 15.91 7.31 16.3 7.7C16.69 8.09 16.69 8.72 16.3 9.11L13.41 12L16.3 14.89C16.68 15.27 16.68 15.91 16.3 16.3Z"/>
						</svg>
					</a>
				</div>
			</div>
		`
	}
}