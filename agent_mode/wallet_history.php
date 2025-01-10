<?php
// Query untuk mengambil data dompet agen berdasarkan agentID
$get_data = "SELECT * FROM delivery_agent_wallet WHERE agentID = $agent_id;";
$result_get = mysqli_query($con, $get_data);
$row_data = mysqli_fetch_assoc($result_get);

// Mendapatkan data dari hasil query
$earning_balance = $row_data["earning_balance"];
$earning_paid = $row_data["earning_paid"];
$earning_total = $row_data["earning_total"];
$transaction_history = $row_data["Transaction_history"];
$upiID = $row_data["upiID"];

// Memecah string riwayat transaksi menjadi array transaksi individual
$transactions = explode("|", $transaction_history);

// Simbol untuk menunjukkan peningkatan atau penurunan saldo
$increase_symbol = "🠕";
$increase = "<span style='color: green; font-size: 24px;'>$increase_symbol</span>";
$decrease_symbol = "🠗";
$decrease = "<span style='color: red; font-size: 24px;'>$decrease_symbol</span>";
?>

<div class="container mt-3">
    <h2 class="text-center">Wallet History</h2>

    <!-- Menampilkan saldo dengan format koma -->
    <h5 class="w-50 m-auto my-3">Current Balance:
        <?php echo "Rp." . number_format($earning_balance, 2, '.', ','); ?>
    </h5>
    <h5 class="w-50 m-auto my-3">Amount Withdrawn:
        <?php echo "Rp." . number_format($earning_paid, 2, '.', ','); ?>
    </h5>
    <h5 class="w-50 m-auto my-3">Total Earning:
        <?php echo "Rp." . number_format($earning_total, 2, '.', ','); ?>
    </h5>

    <table class='table table-bordered mt-4'>
        <thead class='table-info text-center text-white'>
            <tr>
                <th>Transaction Date</th>
                <th>Transaction Detail</th>
                <th>Wallet Balance</th>
                <th>Total Amount Withdrawn</th>
                <th>Total Earning</th>
            </tr>
        </thead>
        <tbody class="table-secondary text-white">
            <?php
            foreach (array_reverse($transactions) as $transaction) {
                $components = explode("^", $transaction);
                
                // Format numbers with commas in the components
                if (isset($components[2]) && is_numeric($components[2])) {
                    $components[2] = number_format((float)$components[2], 2, '.', ',');
                }
                if (isset($components[3]) && is_numeric($components[3])) {
                    $components[3] = number_format((float)$components[3], 2, '.', ',');
                }
                if (isset($components[4]) && is_numeric($components[4])) {
                    $components[4] = number_format((float)$components[4], 2, '.', ',');
                }

                // Add symbols based on transaction type
                if ($components[1][6] == 'a') {
                    $components[2] = $components[2] . " " . $increase;
                    $components[4] = $components[4] . " " . $increase;
                } else if ($components[1][6] == 'e') {
                    $components[2] = $components[2] . " " . $increase;
                    $components[4] = $components[4] . " " . $increase;
                } else if ($components[1][6] == 'i') {
                    $components[2] = $components[2] . " " . $decrease;
                    $components[3] = $components[3] . " " . $increase;
                }

                // Format transaction details to include commas for monetary values
                if (isset($components[1])) {
                    $components[1] = preg_replace_callback(
                        '/Rp(\d+)/',
                        function($matches) {
                            return 'Rp' . number_format((float)$matches[1], 2, '.', ',');
                        },
                        $components[1]
                    );
                }

                echo "<tr class='text-center align-middle'>";
                foreach ($components as $component) {
                    echo "<td>$component</td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>