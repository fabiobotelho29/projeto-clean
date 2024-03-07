<?php

/**
 * CONFIGURAÇÔES DO SITE
 * PRODUCTION URL:https://papaimudoutudo.com.br
 * TESTS URL:https://test.papaimudoutudo.com.br
 * LOCAL URL:localhost/pmt_store
 */
/**
 * CURL
 * DIMONA CAMISA: https://camisadimona.com.br/
 *
 * REGISTRO BR
 * Usuário: WETCO33
 * Senha: mw194448
 *
 * HOSTGATOR
 * Usuário: papaimudou@gmail.com
 * Senha: Pap@imudou1
 *
 */
/*
 * Configurações FTP 
 * TEST
 * HOST:
 * USER:
 * DIR PATH:
 * PASS:
 * 
 * PRODUCTION
 * HOST:
 * USER:
 * DIR PATH:
 * PASS:
 *
 * EMAIL
 * Nesse caso basta configurar conforme os dados abaixo >>

- Servidor de entrada: pop.titan.email / imap.titan.email
- Servidor de saída: smtp.titan.email
- Conta de Email: (Endereço da conta de email)
- Senha: (Senha da conta de email)
- Portas: POP3 SSL 995 / IMAP SSL 993 e SMTP SSL 465
- Marcar todas as opções que usam conexão criptografada e SSL

Para acessar:
https://titan.hostgator.com.br/login/
Email: contato@papaimudoutudo.com.br
Senha: Pap@imudou1

 */

/**
 * ################
 * ### DATABASE ###
 * ################
 */

/** Informações de acesso e de Banco de dados local e online */
if (strpos($_SERVER["HTTP_HOST"], "localhost") !== false) {
    define("CONF_DB_HOST", "localhost"); // Servidor local de teste
    define("CONF_DB_USER", "root"); // Usuário local
    define("CONF_DB_PASS", ""); // Senha local
    define("CONF_DB_NAME", "projeto-clean"); // Nome da base de dados local
} else {
    define("CONF_DB_HOST", ""); // Servidor web do banco de dados
    define("CONF_DB_USER", ""); // Usuário no Servidor
    define("CONF_DB_PASS", ""); // Senha no servidor
    define("CONF_DB_NAME", ""); // nome da base de dados no servidor
}


/**
 * #######################
 * ### URLs DO SISTEMA ###
 * #######################
 */
define("URL_LOCAL", "http://localhost/projeto-clean"); // URL do site no localhost
define("URL_DEPLOY", ""); // URL do site online
define("URL_TEST", ""); // URL para teste

/**
 * #############
 * ### VIEWS ###
 * #############
 */

/** TEMA FRONT */
define("VIEWS_PATH", __DIR__."/../../themes/front");
define("VIEWS_THEME", "front");
define("VIEWS_EXT", "php");
define("VIEWS_FILE", "_theme.php");

/** TEMA FRONT */
define("VIEWS_FRONT_PATH", __DIR__."/../../themes/front");
define("VIEWS_FRONT_THEME", "front");
define("VIEWS_FRONT_EXT", "php");
define("VIEWS_THEME_FRONT_FILE", "_theme.php");

/** PANEL */
// Theme Link: https://preview.keenthemes.com/saul-html-free/index.html
define("VIEWS_PANEL_PATH", __DIR__."/../../themes/panel");
define("VIEWS_PANEL_THEME", "panel");
define("VIEWS_PANEL_EXT", "php");
define("VIEWS_THEME_PANEL_FILE", "_theme.php");
define("VIEWS_THEME_PANEL_DASH_FILE", "_dashboard.php");

/**
 * ##############
 * ### UPLOAD ###
 * ##############
 */
/** Caminho para as pastas de upload das imagens de produtos e logomarcas das empresas clientes */
define("CONF_UPLOAD_DIR", __DIR__ . "/../../images");
define("CONF_UPLOAD_IMAGES_BANNER", __DIR__."/../../themes/front/img/hero/");
define("CONF_UPLOAD_IMAGES_LOGOMARCA", CONF_UPLOAD_DIR . "/logos/");

/**
 * ###########
 * ### SEO ###
 * ###########
 */
/** Informações de SEO do site */
define("SEO_SITE_NAME", "Projeto Clean"); // Nome do site
define("SEO_SITE_SUBTITLE", "Sistema para Lavanderias"); // Subtítulo do site
define("SEO_SITE_DESCRIPTION", "Sua melhor opção pra gerenciar seus serviços de lavagens"); // Descrição do site
define("SEO_SITE_KEYWORDS", "Lavanderia, Lavagens, Roupas, Limpeza"); // Descrição do site
define("SEO_SITE_VERSION", "1.0"); // Versão do sistema
define("SEO_SITE_AUTHOR", "Fabio C. Botelho"); // Autor do Sistema
define("SEO_SITE_DOMAIN", URL_DEPLOY); // domínio do site
define("SEO_SITE_IMAGE", "/images/share-image.png"); // imagem de compartilhamento SEO
define("SEO_SITE_FAVICON", "/images/favicon.png"); // Imagem Favicon
define("SEO_SITE_LOCALE", "pt_BR"); // Linguagem do site
define("SEO_FB_APP_ID", ""); // conta de anúncio do facebook
define("SEO_TWITTER_ACCOUNT", ""); // conta do twitter do cliente (empresa)
define("SEO_TWITTER_CREATOR", ""); // conta de twitter do autor do site
define("SEO_WHATSAPP", "5521988483102"); // conta de twitter do autor do site
define("HTML5_PAGE", "<html itemscope itemtype=\"http://schema.org/Article\" lang='".SEO_SITE_LOCALE."'>");
define("HTML5_PRODUCT", "<html itemscope itemtype=\"http://schema.org/Product\" lang='".SEO_SITE_LOCALE.">");

/**
 * #################
 * ### MENSAGENS ###
 * #################
 */
/** Confiruração das mensagens do site */
define("CONF_MESSAGE_CLASS", "alert");
define("CONF_MESSAGE_INFO", "info");
define("CONF_MESSAGE_SUCCESS", "success");
define("CONF_MESSAGE_WARNING", "warning");
define("CONF_MESSAGE_ERROR", "danger");
define("CONF_MESSAGE_ICON_SUCCESS", "<i class='fa fa-check'></i>");
define("CONF_MESSAGE_ICON_INFO", "<i class='fa fa-exclamation'></i>");
define("CONF_MESSAGE_ICON_WARNING", "<i class='fa fa-exclamation-triangle'></i>");
define("CONF_MESSAGE_ICON_ERROR", "<i class='fa fa-times'></i>");

/**
 * ################
 * ### PASSWORD ###
 * ################
 */
/** COnfigurações das senhas do sistema */
define("CONF_PASSWD_MIN_LEN", 8); // Mínimo de caracteres
define("CONF_PASSWD_MAX_LEN", 40); // Máximo de caracteree
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT); // Algoritmo de criptografia
define("CONF_PASSWD_OPTION", ["cost" => 10]); // Custo de criptografia hash do PHP

/**
 * #############
 * ### DATAS ###
 * #############
 */
/** Padrão de formato de datas para uso do front do sistema inteiro */
define("CONF_DATE_HOUR_BR", "d/m/Y H:i:s");
define("CONF_DATE_BR", "d/m/Y");

define("CONF_DATE_HOUR_APP", "Y-m-d H:i:s");
define("CONF_DATE_APP", "Y-m-d");

/**
 * ###############
 * ### SESSION ###
 * ###############
 */
/** Diretório de armazenamento das sessões */
define("CONF_SES_PATH", __DIR__ . "/../../storage/sessions/");

/**
 * #############
 * ### EMAIL ###
 * #############
 */
define("CONF_MAIL_HOST", "smtp.titan.email"); // Servidor SMTP de Emails
define("CONF_MAIL_PORT", "587"); // Porta de Saída de emails
define("CONF_MAIL_USER", "contato@papaimudoutudo.com.br"); // E-mail utilizado para envo de e-mails do sistema
define("CONF_MAIL_PASS", "Pap@imudou1"); // Senha do email
define("CONF_MAIL_SENDER", ["name" => "Contato", "address" => "contato@papaimudoutudo.com.br"]); // Informações enviadas no email (Nome e e-mail))
define("CONF_MAIL_OPTION_LANG", "br"); // Configuração da linguagem do email
define("CONF_MAIL_OPTION_HTML", true); // Habilitando linguagem HTML no email
define("CONF_MAIL_OPTION_AUTH", true); // Email com autenticação
define("CONF_MAIL_OPTION_SECURE", "tls"); // Padrãod e segurança do servidor
define("CONF_MAIL_OPTION_CHARSET", "utf-8"); // Charset do email

define("CONF_MAIL_REGISTER", ""); // E-mail de registro, normalmente usado para cadastrar no serviço de hospedagem e receber informações de novo cadastro

/**
 * #########################
 * ### ADMIN CREDENTIALS ###
 * #########################
 */

define("ADMIN_USER", ""); // Usuário ADMIN para acesso ao painal
define("ADMIN_PASSWD", ""); // Senha do usuario admin

/**
 * ########################
 * ### LIMITE PAGINAÇÃO ###
 * ########################
 */
define("LIMITE_PAGINACAO", 30);

/**
 * #####################
 * ### REDES SOCIAIS ###
 * #####################
 */
define("FACEBOOK", "");
define("INSTAGRAM", "");
define("TIKTOK", "");