<html>
<link rel="shortcut icon" href="{{ asset('gambar/logo-vbook.png') }}" />
<link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<style>
    body {
        background: #fff;
        font-family: 'Montserrat', sans-serif;
        margin: 0;
        padding: 0;
    }

    .ticket {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 800px;
        margin: 30px auto;
    }

    .ticket .stub,
    .ticket .check {
        box-sizing: border-box;
    }

    .stub {
        background: #3FD8C3;
        height: 250px;
        width: 250px;
        color: white;
        padding: 20px;
        position: relative;
    }

    .stub:before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        border-top: 20px solid #fff;
        border-left: 20px solid #3FD8C3;
        width: 0;
    }

    .stub:after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        border-bottom: 20px solid #fff;
        border-left: 20px solid #3FD8C3;
        width: 0;
    }

    .stub .top {
        display: flex;
        align-items: center;
        height: 40px;
        text-transform: uppercase;
    }

    .stub .top .line {
        display: block;
        background: #fff;
        height: 40px;
        width: 3px;
        margin: 0 20px;
    }

    .stub .top .num {
        font-size: 12px;
    }

    .stub .top .num span {
        color: #fff;
    }

    .stub .number {
        position: absolute;
        left: 40px;
        font-size: 115px;
    }

    .stub .invite {
        position: absolute;
        left: 150px;
        bottom: 45px;
        color: #000;
        width: 20%;
    }

    .stub .invite:before {
        content: '';
        background: #fff;
        display: block;
        width: 40px;
        height: 3px;
        margin-bottom: 5px;
    }

    .check {
        background: #CDFFF8;
        height: 250px;
        width: 450px;
        padding: 40px;
        position: relative;
    }

    .check:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        border-top: 20px solid #fff;
        border-right: 20px solid #CDFFF8;
        width: 0;
    }

    .check:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        border-bottom: 20px solid #fff;
        border-right: 20px solid #CDFFF8;
        width: 0;
    }

    .check .big {
        font-size: 25px;
        font-weight: 320;
        line-height: 1.8em;
    }

    .check .number {
        position: absolute;
        top: 40px;
        right: 40px;
        color: #3FD8C3;
        font-size: 30px;
    }

    .check .info {
        display: flex;
        justify-content: flex-start;
        font-size: 12px;
        margin-top: 20px;
        width: 100%;
    }

    .check .info section {
        margin-right: 50px;
    }

    .check .info section:before {
        content: '';
        background: #3FD8C3;
        display: block;
        width: 30px;
        height: 3px;
        margin-bottom: 5px;
    }

    .check .info section .title {
        font-size: 10px;
        text-transform: uppercase;
    }
</style>

<div class="container col-8 text-center py-4">
    <div class="card">
        <div class="card-body">
            <img src="/gambar/company/{{ $company->company->logo }}" width="90px" alt="">

            <div class="ticket">
                <div class="stub">
                    <div class="top">
                        <span class="admit">DEVICE</span>
                        <span class="line"></span>
                        <span class="num">

                            <span>{{ $company->company->name }}</span>
                        </span>
                    </div>
                    <div class="number">{{ $company->licence->max_device ?? '-'}}</div>

                </div>
                <div class="check">
                    <span> Your Licence :</span>
                    <div class="big">
                        {{ $company->licence->code ?? '-'}}
                    </div>
                    <br>
                    <br>

                    <div class="info">
                        <section>
                            <div class="title">Created</div>
                            <div>{{ \Carbon\Carbon::parse($company->licence->created_at ?? '00/00/0000')->format('d/m/Y')}}</div>
                        </section>
                        <section>
                            <div class="title">Device Used</div>
                            <div>{{ $company->licence->count_device ?? '-' }}</div>
                        </section>
                        <section>
                            <div class="title">Status</div>
                            @if(isset($company->licence->count_device ))
                            @if(($company->licence->count_device) < ($company->licence->max_device))
                                <div>Available</div>
                                @else
                                <div>Full</div>
                                @endif
                                @else
                                <div>-</div>
                                @endif

                        </section>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="alert alert-primary" role="alert">
                if your licence status is full please contact VBOOK
            </div>

        </div>
    </div>
</div>

<div class="text-center">
    <a href="/admin/setting" class="btn btn-primary">Back</a>
</div>

</html>