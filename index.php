<!DOCTYPE html>
<html ng-app>
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="Thiago Jourdan" />
        <title>Software teste de banco de dados de estoque</title>
        <?php
            require_once("php/mainFunctions.php");
            loadFiles("{'css':['bootstrap','sweetalert','mainStyle']}");
            loadFiles("{'js':['frameworks/angular','libs/jQuery','libs/bootstrap','plugins/sweetalert','plugins/sonic','plugins/inputMasks','js','mainFunctions']}");
            sessionBegin();
        ?>
    </head><!-- Head -->
    <body>
        <div class="container col-lg-12">
            <div class="row" style="background:#E7E7E7">
                <img
                    src="data:image/png;base64,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"
                alt="Controk Logo" />
            </div>
            <div class="row">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="true">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li><a>Funcionário</a></li>
                                <li><a>Fornecedor</a></li>
                                <li><a>Cliente</a></li>
                                <li><a>Remessa</a></li>
                                <li><a>Produto</a></li>
                                <li><a>Estoque</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="row"><div class="container col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1"></div></div>
        </div>
    </body>
</html>