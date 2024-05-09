<h3 class="mt-2">Activity Logs</h3>
<div class="card card-outline card-danger">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-stripped table-sm" id="user-datatables">
                <thead>
                    <tr>
                        <th class="text-center">Timestamp</th>
                        <th class="text-center">User Activity</th>
                        <th class="text-center">User</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($activity as $log) : ?>
                        <tr>
                            <td class="text-center"><?= $log->timestamp ?></td>
                            <td class="text-center"><?= $log->activity ?></td>
                            <td class="text-center"><?= $log->user ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>