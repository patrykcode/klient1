<!doctype html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Ukraine praca</title>
        <script src="{{asset('admin/js/alerts.js')}}"></script>
        <link type="text/css" rel="stylesheet" href="{{asset('admin/css/alerts.css')}}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

        <style>
            html,body{
                font-size:14px;
                font-family: 'Montserrat', sans-serif;
                max-width: 1920px;
                margin: auto;
            }
            h1{

                font-size: 5em;
                font-weight: 700;
                color: #fff;
                text-shadow: 1px 1px 3px #000;
            }
            .pa-h1{
                font-size: 1.2em;
                font-weight: 700;
                color: #fff;
                text-shadow: 1px 1px 3px #000;
            }
            .fly-text{
                position: absolute;
                top:20%;
                padding-left:5%;
            }
            .form-h2{
                font-size: 3em;
                font-weight: 600;
            }
            .section-h3{
                font-size: 2.5em;
                font-weight: 600;
                text-align: center;
            }
            .footer-h3{
                font-size: 2em;
                font-weight: 700;

            }
            .bg-black{
                background:#191919;
            }
            .bg-light2{
                background: #f5f5f5;
            }
            .card{
                border-color: transparent;
                box-shadow: 1px 1px 3px #ddd;

            }
            footer li a{
                color:#fff;
            }
            footer ul {
                list-style: none;
                padding-left: 0;
            }
            @media(max-width:768px){
                .text-footer{
                    text-align:center;
                }
                .form-h2 {
                    font-size: 1.5em;
                }
                .section-h3 {
                    font-size: 1.5em;
                }
                h1 {
                    font-size: 3em;
                }
            }
            @media(max-width:500px){
                .pa-h1{
                    display:none;
                }

            }

        </style>
    </head>
    <body>
        @include('cms::includes.alerts')

        <section class="container-fluid p-0 position-relative"> 
            <img src="<?= url($article1->img ?? ''); ?>" class="img-fluid"/>
            <div class="fly-text">
                <h1><b>3M</b> Inwestycje</h1>
                <div class="w-50 pa-h1">
                    <?= $article1->descLang->addmission ?? ''; ?>
                </div>
                
            </div>
        </section>
        <section class="container-fluid bg-page bg-light2 d-none">
            <div class="container py-5">
                <div class="row mb-3">
                    <div class="col-xl-4 col-lg-4 col-md-12">
                        <h3 class="mt-4 mb-3 section-h3">Wspólpraca</h1>
                            <div class="card">
                                <div class="card-body">
                                    <?= $article1->descLang->addmission ?? ''; ?>
                                </div>
                            </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12">
                        <h3 class="mt-4 mb-3 section-h3">Rekrutacja</h1>
                            <div class="card">
                                <div class="card-body">
                                    <?= $article1->descLang->description ?? ''; ?>
                                </div>
                            </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12">
                        <h3 class="mt-4 mb-3 section-h3">Oferujemy</h1>
                            <div class="card">
                                <div class="card-body">
                                    <?= $article2->descLang->description ?? ''; ?>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="container-fluid py-5">

            <div class="container">
                <h2 class="my-3 text-center form-h2">Jeśli zamierzasz zostać naszym pracownikiem wypełnij formularz</h2>
                <div class="row justify-content-md-center">
                    <div class="col-lg-8 col-md-12">
                        <form action="/send" method="POST">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-6 col-md">
                                    <div class="form-group">
                                        <label for="">Nr. telefonu <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" pattern="[0-9]{9,11}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md">
                                    <div class="form-group">
                                        <label for="" >Imię i nazwisko <span class="text-danger">*</span></label>
                                        <input type="text" name="name" pattern="[A-Za-z\s]{,50}" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md">
                                    <div class="form-group">
                                        <label for="">Nardowość <span class="text-danger">*</span></label>
                                        <select class="form-control" name="country" required>
                                            <option value="Białoruś">Białoruś</option>
                                            <option value="Polska">Polska</option>
                                            <option value="Rosja">Rosja</option>
                                            <option value="Ukraina">Ukraina</option>
                                            <option value="Inna">Inna (podaj w komantarzu)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md">
                                    <div class="form-group">
                                        <label for="">Data urodzenia <span class="text-danger">*</span></label>
                                        <input type="date" name="bdate" class="form-control"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md">
                                    <div class="form-group">
                                        <label for="">Kwalifikacje/zawód <span class="text-danger">*</span></label>
                                        <input type="text" name="qualifications" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md">
                                    <div class="form-group">
                                        <label for="">Umiejętności manualne <span class="text-danger">*</span></label>
                                        <input type="text" name="skills" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md">
                                    <div class="form-group">
                                        <label for="">Języki <span class="text-danger">*</span></label>
                                        <input type="text" name="langs" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md">
                                    <div class="form-group">
                                        <label for="">Zarobki - oczekiwania finansowe <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="paymants" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md">
                                    <div class="form-group">
                                        <label for="">Gotowość do pracy</label>
                                        <input type="date" name="sdate" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md">
                                    <div class="form-group">
                                        <label for="">Komentarz</label>
                                        <textarea name="comments" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="agree">
                                    <input type="checkbox" id="agree" require> 
                                    Wyrażam zgodę na przetwarzanie moich danych osobowych przez 3M Inwestycje w celu prowadzenia rekrutacji na aplikowane przeze mnie stanowisko.
                                    <span class="text-danger">*</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="float-right btn w-50 btn-primary" value="Wyślij">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>

        <footer class="container-fluid bg-black text-white py-5 text-footer">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-4 col-md-6">
                        <h3 class="footer-h3">3M Inwestycje</h3>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <?= $article2->descLang->addmission ?? ''; ?>
                    </div>
                    <div class="col-lg-12 text-center">
                        <p class="text-muted">3M Inwestycje &copy; <span><?= date('Y'); ?></span> · All Rights Reserved</p>
                    </div>
                </div>


            </div>

        </footer>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
    </body>
</html>
