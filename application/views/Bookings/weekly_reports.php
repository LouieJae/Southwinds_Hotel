<div class="tab-content" id="moduleTabContent">
    <div class="tab-pane fade show active" id="module2">
        <div class="card-header">

            <div class="card-body" style="color: dark;">

                <table class="table" id="user-datatables-module1">

                    <thead>
                        <tr>
                            <th>Room No.</th>
                            <th>Week 1</th>
                            <th>Week 2</th>
                            <th>Week 3</th>
                            <th>Week 4</th>
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


                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>