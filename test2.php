<!DOCTYPE html>
<html>
<head>
	<style>
		body {
			background-color: #f7f7f7;
		}
		
		.progress-bar {
			background-color: #e5e5e5;
			border-radius: 20px;
			height: 20px;
			width: 600px;
			padding: 5px;
			box-shadow: 0 2px 5px rgba(0,0,0,0.2);
		}
		
		.progress-bar .progress {
			height: 100%;
			width: 0%;
			background-color: #f06161;
			border-radius: 20px;
			transition: width 0.2s ease-in-out;
		}
		
		.status {
			font-size: 18px;
			font-weight: bold;
			margin-top: 20px;
			color: #555;
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="progress-bar">
		<div class="progress" style="width: 25%;"></div>
	</div>
	<div class="status">Status: Requested</div>

	<script>
		let currentStatus = 1;
		
		function setStatus(status) {
			if (status > currentStatus) {
				currentStatus = status;
				const progress = document.querySelector('.progress');
				progress.style.width = `${25 * currentStatus}%`;
				
				const statusText = document.querySelector('.status');
				switch (currentStatus) {
					case 1:
						statusText.textContent = 'Status: Requested';
						break;
					case 2:
						statusText.textContent = 'Status: Accepted';
						break;
					case 3:
						statusText.textContent = 'Status: Working';
						break;
					case 4:
						statusText.textContent = 'Status: Complete';
						break;
				}
			}
		}
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function(event) {
			const options = document.querySelectorAll('.option');
			options.forEach(option => {
				option.addEventListener('click', () => {
					setStatus(parseInt(option.dataset.status));
					options.forEach(o => {
						if (parseInt(o.dataset.status) <= currentStatus) {
							o.classList.add('completed');
						} else {
							o.classList.remove('completed');
						}
					});
				});
			});
		});
	</script>
</body>
</html>
