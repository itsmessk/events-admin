<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
	header("location:login.html");
}
include_once "dbconnect.php";

if (isset($_POST['delete_event_id'])) {
    $eventToDelete = $_POST['delete_event_id'];
    
    // Perform the deletion query here
    $deleteQuery = "DELETE FROM events WHERE e_id = ?";
    $stmt = $con->prepare($deleteQuery);
    $stmt->bind_param("s", $eventToDelete);
    
    if ($stmt->execute()) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "message" => "Failed to delete event."));
    }
    
    $stmt->close();
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Events</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>

<body>
	<?php

	$sql = "SELECT * FROM events ";
	$result = $con->query($sql);
	$rowcount = mysqli_num_rows($result);
	?>

	<!DOCTYPE html>
	<html>

	<head>
    <title>Events</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
        }

        .event-table {
            width: 100%;
            border-collapse: collapse;
            margin: auto;
            margin-top: 30px;
        }

        .event-table th,
        .event-table td {
            padding: 12px;
            text-align: left;
        }

        .event-table th {
            background-color: #f2f2f2;
        }

        .event-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .btn-center {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
		.bord{
			border: 1px solid grey;
		}
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container" >
        <table class="event-table" class="bord">
            <thead class="bord" >
                <tr>
                    <th class="bord">Event ID</th>
                    <th class="bord">Event Name</th>
                    <th class="bord">Event Description</th>
                    <th class="bord">Event Date & Time</th>
                    <th class="bord">Event Venue</th>
                    <th class="bord">Action</th>
                </tr>
            </thead>
            <tbody class="bord">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr class="bord">
                        <td class="bord"><?= $row["e_id"] ?></td>
                        <td class="bord"><?= $row["e_name"] ?></td>
                        <td class="bord"><?= $row["e_desc"] ?></td>
                        <td class="bord"><?= $row["e_date"] ?> <?= $row["e_time"] ?></td>
                        <td class="bord"><?= $row["e_venue"] ?></td>
                        <td>
                            <button class="btn btn-delete" data-event-id="<?= $row['e_id'] ?>">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="btn-center">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addEventModal">Add Event</button>
        </div>
    </div>

	<div class="modal fade" id="addEventModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add Event</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<!-- Your form content here -->
					<form action="" method="post" style="display: flex; flex-direction: column; align-items: center;">
						<div
							style="display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 10px;">
							<label for="eventname" style="font-size: 18px;">Event Name:</label>
							<input type="text" value="" name="eventname" style="width: 100%;" />
						</div>
						<div
							style="display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 10px;">
							<label for="eventdate" style="font-size: 18px;">Event Date:</label>
							<input class="i2" type="date" value="" name="eventdate" min="2020-06-06" required
								style="width: 100%;" />
						</div>
						<div
							style="display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 10px;">
							<label for="eventtime" style="font-size: 18px;">Event Time:</label>
							<input class="i3" type="time" value="" name="eventtime" style="width: 100%;" />
						</div>
						<div
							style="display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 10px;">
							<label for="eventdesc" style="font-size: 18px;">Event Description:</label>
							<textarea name="eventdesc" cols="60" rows="6" style="width: 100%;"></textarea>
						</div>
						<div
							style="display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 10px;">
							<label for="eventvenue" style="font-size: 18px;">Event Venue:</label>
							<input type="text" value="" name="eventvenue" style="width: 100%;" />
						</div>
						<div
							style="display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 10px;">
							<label for="epic" style="font-size: 18px;">Person in Charge:</label>
							<input type="text" value="" name="epic" style="width: 100%;" />
						</div>
						<div
							style="display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 10px;">
							<label for="e_url" style="font-size: 18px;">Registration URL:</label>
							<input type="text" value="" name="e_url" style="width: 100%;" />
						</div>
						<!-- <input type="submit" value="Submit" style="width: 150px; align-self: center; margin-top: 20px; padding: 10px; font-size: 18px; background-color: #4CAF50; color: white; border: none; cursor: pointer;" /> -->
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" name="addEvent">Add Event</button>
				</div>
			</div>
		</div>
	</div>


	</div>

	</div>
	<br><br><br>

	</form>
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			var popup = document.getElementById("popup");
			var openPopupButton = document.getElementById("openPopup");

			openPopupButton.addEventListener("click", function () {
				popup.style.display = "block";
			});

			// You can also add code to close the popup when necessary.
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			var popup = document.getElementById("popup");
			var openPopupButton = document.getElementById("openPopup");

			openPopupButton.addEventListener("click", function () {
				popup.style.display = "block";
			});

			var form = document.getElementById("yourFormId"); // Replace with your actual form ID

			form.addEventListener("submit", function (event) {
				event.preventDefault();

				fetch("add_event.php", {
					method: "POST",
					body: new FormData(form)
				})
					.then(response => response.text())
					.then(data => {
						// Handle the response here, e.g., show a success message
						console.log(data);
						// Close the popup if needed
						popup.style.display = "none";
					})
					.catch(error => {
						// Handle errors
						console.error(error);
					});
			});
		});
	</script>
	<?php

	if (isset($_POST['addEvent'])) {
		$ENAME = mysqli_real_escape_string($con, $_REQUEST['eventname']);
		$EDATE = mysqli_real_escape_string($con, $_REQUEST['eventdate']);
		$ETIME = mysqli_real_escape_string($con, $_REQUEST['eventtime']);
		$EDESC = mysqli_real_escape_string($con, $_REQUEST['eventdesc']);
		$EVENUE = mysqli_real_escape_string($con, $_REQUEST['eventvenue']);
		$EPIC = mysqli_real_escape_string($con, $_REQUEST['epic']);
		$EURL = mysqli_real_escape_string($con, $_REQUEST['e_url']);

		if ($ENAME == '' || $EDATE == '' || $ETIME == '' || $EDESC == '' || $EVENUE == '' || $EPIC == '' || $EURL == '') {
			echo "<br /><p class='p1'>*****Incomplete information. No Event Created.*****</p>";
		} else {
			$sql = "INSERT INTO events (e_name, e_date, e_time, e_desc, e_venue, e_pic, e_url) VALUES('$ENAME', '$EDATE', '$ETIME', '$EDESC', '$EVENUE', '$EPIC', '$EURL')";
			if ($con->query($sql) === TRUE) {
				echo "<br /><p class='p1'>*****Event successfully created.*****</p>";
				echo '<meta http-equiv="refresh" content="2;url=events.php">';
			} else {
				echo "Error: " . $sql . "<br>" . $con->error;
			}
		}
	}
	?>
	

	<script>
		document.addEventListener("DOMContentLoaded", function () {
			const deleteButtons = document.querySelectorAll(".btn-delete");

			// ... Your existing JavaScript code ...
			// ... Your existing JavaScript code ...

			deleteButtons.forEach(button => {
				button.addEventListener("click", function () {
					const eventId = button.getAttribute("data-event-id");

					if (confirm("Are you sure you want to delete this event?")) {
						fetch("events.php", {
							method: "POST",
							headers: {
								"Content-Type": "application/x-www-form-urlencoded",
							},
							body: `delete_event_id=${eventId}`,
						})
							.then(response => response.json())
							.then(data => {
								if (data.success) {
									// Update UI: Remove the deleted row
									const deletedRow = button.closest("tr");
									deletedRow.remove();
								} else {
									console.error("Failed to delete event.");
								}
							})
							.catch(error => {
								console.error("AJAX request error:", error);
							});
					}
				});
			});

			// ... Rest of your JavaScript code ...


		});


	</script>



</body>

</html>