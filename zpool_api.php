<?php
date_default_timezone_set('Asia/Bangkok');

echo '
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="refresh" content="10">
<title>ZPOOL - PHP API</title>
</head>';


$wallet = 'Xy4y9qo9V2byDCVHnzkWYmQ7gB7NQejqfb';


$demical = 2;
$b_width = 18;
$url = 'https://www.zpool.ca/api/walletEX?address='.$wallet;
$json = file_get_contents($url);
$array = json_decode($json, true);


echo '<pre>';
echo '<h1>ZPOOL - PHP API</h1>';
echo '<a href="https://zpool.ca/wallet/'.$wallet.'">View on ZPOOL</a>';

echo '<h4>Wallet: '.$wallet.'</h4>';

echo str_pad('Currency |', $b_width, ' ', STR_PAD_LEFT);
echo str_pad('Confirm |', $b_width, ' ', STR_PAD_LEFT);
echo str_pad('Pending |', $b_width, ' ', STR_PAD_LEFT);
echo '<br>';
echo str_pad($array['currency'].' |', $b_width, ' ', STR_PAD_LEFT);
echo str_pad(number_format($array['balance'], $demical).' |', $b_width, ' ', STR_PAD_LEFT);
echo str_pad(number_format($array['unsold'], $demical).' |', $b_width, ' ', STR_PAD_LEFT);
echo '<br>';
echo str_pad('', $b_width*3, '-', STR_PAD_LEFT);
echo '<br>';
echo str_pad('Unpaid |', $b_width, ' ', STR_PAD_LEFT);
echo str_pad('Paid |', $b_width, ' ', STR_PAD_LEFT);
echo str_pad('Total |', $b_width, ' ', STR_PAD_LEFT);
$array['paid'] = ($array['total'] - $array['unpaid']);
echo '<br>';
echo str_pad(number_format($array['unpaid'], $demical).' |', $b_width, ' ', STR_PAD_LEFT);
echo str_pad(number_format($array['paid'], $demical).' |', $b_width, ' ', STR_PAD_LEFT);
echo str_pad(number_format($array['total'], $demical).' |', $b_width, ' ', STR_PAD_LEFT);


echo '<h2>Miners</h2>';
if (count($array['miners']) > 0):
	echo '<table>';
		echo '<tr>';
		echo '<th>ID</th>';
		echo '<th>ALGO</th>';
		echo '<th>ACCEPTED</th>';
		echo '<th>REJECTED</th>';
		echo '<th>DIFF</th>';
		echo '<th>SUBSCRIBE</th>';
		echo '<th>VER</th>';
		echo '<th>X</th>';
		echo '</tr>';
	foreach ($array['miners'] as $key => $value):
		echo '<tr>';
		echo '<td>'.$value['ID'].'</td>';
		echo '<td>'.$value['algo'].'</td>';
		echo '<td>'.number_format($value['accepted'], 2).'</td>';
		echo '<td>'.number_format($value['rejected'], 2).'</td>';
		echo '<td>'.number_format($value['difficulty'], 2).'</td>';
		echo '<td>'.$value['subscribe'].'</td>';
		echo '<td>'.$value['version'].'</td>';
		echo '<td>'.$value['password'].'</td>';
		echo '</tr>';
		$sum_accepted[] = $value['accepted'];
	endforeach;
		echo '<tr>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td>'.number_format(array_sum($sum_accepted), 2).'</td>';
		echo '<td></td>';
		echo '</tr>';
	echo '</table>';
else:
	echo 'Miner not detected';
endif;


echo '<h2>Payouts</h2>';
if (count($array['payouts']) > 0):
	echo '<table>';
		echo '<tr>';
		echo '<th>Time</th>';
		echo '<th>Amount</th>';
		echo '<th>TxID</th>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Paid 24h</td>';
		echo '<td style="text-align:right; width:150px; padding-right:10px;">'.number_format($array['paid24h'], 2).'</td>';
		echo '<td></td>';
		echo '</tr>';

		
	foreach ($array['payouts'] as $key => $value):
		echo '<tr>';
		echo '<td>'.date('Y-m-d H:i:s', $value['time']).'</td>';
		echo '<td style="text-align:right; width:150px; padding-right:10px;">'.number_format($value['amount'], $demical).'</td>';
		echo '<td><span title="'.$value['tx'].'">TX</span></td>';
		echo '</tr>';
		$sum_payout[] = $value['amount'];
	endforeach;
		echo '<tr>';
		echo '<td>Total</td>';
		echo '<td style="text-align:right; width:150px; padding-right:10px;">'.number_format(array_sum($sum_payout), $demical).'</td>';
		echo '<td></td>';
		echo '</tr>';
	echo '</table>';
else:
	echo 'Payout not detected';
endif;


// print_r($array);
echo '</pre>';
?>
