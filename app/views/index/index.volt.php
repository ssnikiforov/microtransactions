<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" type="text/css" href="/css/milligram.css">
</head>
<body>
<div class="container">
    <h2>Accounts</h2>
    <div class="row">
        <div class="column">
            <?php if ($accounts) { ?>
                <table>
                    <thead>
                    <tr>
                        <th>Number</th>
                        <th>Balance</th>
                        <th>_id</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($accounts as $account) { ?>
                        <tr>
                            <td><?= $account->id ?></td>
                            <td><?= $account->balance ?></td>
                            <td><?= $account->_id ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?><p>Use this to populate mongo:</p>
                <pre><code>> use microtransactions_system
> db.accounts.insert({id: 1, balance: 0})
> db.accounts.insert({id: 2, balance: 0})</code></pre>
            <?php } ?>
        </div>
    </div>

    <h2>Operations</h2>
    <div class="row">
        <div class="column">
            <form method="post" action="index/deposit">
                <fieldset>
                    <label for="number">Account Number</label>
                    <input type="number" min="0" placeholder="" id="number">
                    <label for="amount">Amount</label>
                    <input type="number" min="0" placeholder="" id="amount">
                    <input class="button-primary" type="submit" value="Deposit">
                </fieldset>
            </form>
        </div>
        <div class="column">
            <form method="post" action="index/withdraw">
                <fieldset>
                    <label for="number">Account Number</label>
                    <input type="number" min="0" placeholder="" id="number">
                    <label for="amount">Amount</label>
                    <input type="number" min="0" placeholder="" id="amount">
                    <input class="button-primary" type="submit" value="Withdraw">
                </fieldset>
            </form>
        </div>
        <div class="column">
            <form method="post" action="index/transfer">
                <fieldset class="container">
                    <div class="row">
                        <div class="column">
                            <label for="from">Source</label>
                            <input type="number" min="0" placeholder="" id="from">
                        </div>
                        <div class="column">
                            <label for="to">Destination</label>
                            <input type="number" min="0" placeholder="" id="to">
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <label for="amount">Amount</label>
                            <input type="number" min="0" placeholder="" id="amount">
                            <input class="button-primary" type="submit" value="Transfer">
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

    <h2>Last Operation Result</h2>
    <pre><code>Success</code></pre>
</div>

</body>
</html>

