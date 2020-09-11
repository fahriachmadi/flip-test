<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Flip Test</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
              <div class="jumbotron">
                <h1 class="display-4">Disbursement Service</h1>
                <hr class="my-4">
                <p class="lead">Please fill in information below</p>
                <div class="row">
                  <div class="col-4">
                    <form method="POST" action="/send-disbursement">
                        @csrf
                        <div class="form-group">
                          <label for="bank_code">Bank Code</label>
                          <input type="text" class="form-control" id="bank_code" name="bank_code" aria-describedby="bank_code">
                        </div>
                        <div class="form-group">
                          <label for="account_number">Account Number</label>
                          <input type="text" class="form-control" id="account_number" name="account_number">
                        </div>
                        <div class="form-group">
                          <label for="amount">Amount</label>
                          <input type="text" class="form-control" id="amount" name="amount">
                        </div>
                        <div class="form-group">
                          <label for="remark">Remark</label>
                          <input type="text" class="form-control" id="remark" name="remark">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </body>
</html>
