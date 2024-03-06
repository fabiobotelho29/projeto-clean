<?php $v->layout(VIEWS_THEME_FRONT_FILE); ?>
<?php include('header.php'); ?>
<div id="active-page" title="contact"></div>


    <!-- Map Begin -->
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3672.710974830305!2d-43.36070172570144!3d-22.997653341122913!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9bda482f3cf5b5%3A0xa7dd934e3fdd28bf!2sBarra%20Shopping!5e0!3m2!1spt-BR!2sbr!4v1702330067575!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- Map End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Informações</span>
                            <h2>Contato</h2>
                            <p>Caso você precise de alguma informação, envie-nos uma mensagem.</p>
                        </div>
                        <ul>
                            <li>
                                <h4>Endereço</h4>
                                <p>Avenida das Américas, 4666 <br />+55 21-9584-9855</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form action="<?= url("/api/sendWhatsContact"); ?>" method="post">
                            <?= csrf_input(); ?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input name="name" type="text" placeholder="Nome">
                                </div>
                                <div class="col-lg-6">
                                    <input name="email" type="text" placeholder="Email">
                                </div>
                                <div class="col-lg-12">
                                    <input name="phone" type="text" class="numero" placeholder="Telefone com DDD">
                                </div>

                                <div class="col-lg-12">
                                    <textarea name="message" placeholder="Sua Mensagem"></textarea>
                                    <div class="loadResult"></div>
                                    <button type="submit" class="site-btn">Enviar Mensagem</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div class="loadResponse"></div>
    <!-- Contact Section End -->

<?php include('footer.php'); ?>

<?php include('search.php'); ?>