<?php $v->layout(VIEWS_THEME_ADMIN_DASH_FILE); ?>


<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">

<?php $v->insert("header.php"); ?>

<div class="app-body">

    <?php $v->insert("sidebar.php"); ?>

    <!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb"></ol>

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="card-body p-3 clearfix">
                                <i class="fa fa-users bg-primary p-3 font-2xl mr-3 float-left"></i>
                                <div class="h5 text-primary mt-2 mb-0"><?= rand(100, 200); ?></div>
                                <div class="text-muted text-uppercase font-weight-bold font-xs">Clientes</div>
                            </div>
                        </div>
                    </div>
                    <!--/.col-->

                    <div class="col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="card-body p-3 clearfix">
                                <i class="fa fa-list bg-primary p-3 font-2xl mr-3 float-left"></i>
                                <div class="h5 text-primary mt-2 mb-0"><?= rand(100, 200); ?></div>
                                <div class="text-muted text-uppercase font-weight-bold font-xs">Pedidos</div>
                            </div>
                        </div>
                    </div>
                    <!--/.col-->

                    <div class="col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="card-body p-3 clearfix">
                                <i class="fa fa-dollar bg-primary p-3 font-2xl mr-3 float-left"></i>
                                <div class="h5 text-primary mt-2 mb-0"><?= currency(rand(100, 200)); ?></div>
                                <div class="text-muted text-uppercase font-weight-bold font-xs">Faturamento</div>
                            </div>
                        </div>
                    </div>
                    <!--/.col-->
                </div>
                <!--/.row-->

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="card-title mb-0">Balanço Mensal</h4>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="card">
                                            <div class="card-body p-3 clearfix">
                                                <i class="fa fa-dollar bg-warning p-3 font-2xl mr-3 float-left"></i>
                                                <div class="h5 text-success mt-2 mb-0"><?= rand(10,1000); ?></div>
                                                <div class="text-muted text-uppercase font-weight-bold font-xs">
                                                    Pedidos Mensais
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="card">
                                            <div class="card-body p-3 clearfix">
                                                <i class="fa fa-dollar bg-warning p-3 font-2xl mr-3 float-left"></i>
                                                <div class="h5 text-success mt-2 mb-0"><?= currency(rand(10,1000)); ?></div>
                                                <div class="text-muted text-uppercase font-weight-bold font-xs">
                                                    Faturamento Mensal
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/.col-->
                        </div>
                        <!--/.row-->
                    </div>

                </div>
                <!--/.card-->
            </div>

        </div>
        <!-- /.conainer-fluid -->
    </main>

</div>