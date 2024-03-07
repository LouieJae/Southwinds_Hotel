<!-- Daily Report -->

<div class="tab-content" id="moduleTabContent">
    <!-- Module 1 Content -->
    <div class="tab-pane fade show active" id="module1">
        <div class="card-header">

            <div class="card-body" style="color: dark;">

                <table class="table" id="user-datatables-module1">

                    <thead>
                        <tr>
                            <th>Room No.</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                            <th>Saturday</th>
                            <th>Sunday</th>
                            <th>Total Sales</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($room as $rm) {
                            $room_id = $rm->room_id;
                        ?>
                            <!-- Replace the following rows with dynamic data from your backend -->
                            <tr>
                                <td>Room <?= $rm->room_no ?> </td>
                                <td>₱ <?= $room_id ?></td>
                                <td>₱ <?= $rm->room_no ?></td>
                                <td>₱ <?= $rm->room_no ?></td>
                                <td>₱ <?= $rm->room_no ?></td>
                                <td>₱ <?= $rm->room_no ?></td>
                                <td>₱ <?= $rm->room_no ?></td>
                                <td>₱ <?= $rm->room_no ?></td>
                                <td>₱ <?= $rm->room_no ?></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>