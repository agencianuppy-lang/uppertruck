<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../auth/login.php');
    exit;
}

require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
require_once '../includes/topbar.php';
?>

<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

<div class="container-fluid mt-4 df">
	<h4 class="mb-4">Calendário de Posts Agendados</h4>
	<div id='calendar'></div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		var calendarEl = document.getElementById('calendar');
		var calendar = new FullCalendar.Calendar(calendarEl, {
			initialView: 'dayGridMonth',
			locale: 'pt-br',
			events: 'load_events.php',
			eventClick: function (info) {
				window.location.href = '../modules/posts/edit.php?id=' + info.event.id;
			}
		});
		calendar.render();
	});
</script>

<style>
	#calendar {
		background: white;
		padding: 20px;
		border-radius: 8px;
	}

	.fc-event {
		cursor: pointer;
	}

	.fc .fc-daygrid-body-unbalanced .fc-daygrid-day-events {
		min-height: 2rem;
		position: relative;
		height: 11rem;
		overflow-x: hidden;
		overflow-y: scroll;
	}

	.fc .fc-daygrid-day.fc-day-today {
		background-color: #135b2b0a;
	}
</style>

<?php require_once '../includes/footer.php'; ?>