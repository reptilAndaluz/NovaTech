<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="NovaTech: digitalización presencial sencilla, formación práctica y Business Copilot IA para pequeños negocios y comercios locales." />
        <meta name="author" content="NovaTech" />
        <title>NovaTech</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/custom-theme.css') }}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top">NovaTech</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menú
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#services">Servicios</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Propuesta</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">Recorrido</a></li>
                        <li class="nav-item"><a class="nav-link" href="#team">Equipo</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contacto</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Tu socio digital de confianza</div>
                <div class="masthead-heading text-uppercase">Te acompañamos en persona y tu negocio te habla claro</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#services">Descubre cómo</a>
            </div>
        </header>

        <!-- Services-->
        @php
            $services = [
                [
                    'icon' => 'fa-laptop-code',
                    'title' => 'Digitaliza Fácil',
                    'description' => 'Servicio integral y personalizado para dar el salto digital: creación de páginas web, instalación de herramientas digitales, automatización y formación básica.',
                ],
                [
                    'icon' => 'fa-robot',
                    'title' => 'Business Copilot (Agente IA)',
                    'description' => 'Asistente de inteligencia artificial que responde preguntas cotidianas por texto o voz —«¿Cuánto he vendido este mes?» o «¿Cuánto dinero he gastado?»— para gestionar stock y administración sin saber tecnología.',
                ],
                [
                    'icon' => 'fa-handshake',
                    'title' => 'Acompañamiento por Suscripción',
                    'description' => 'Priorizamos el trato presencial visitando tu establecimiento, con reuniones periódicas de seguimiento remoto durante los meses que necesites hasta ganar autonomía.',
                ],
            ];
        @endphp
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Servicios Principales</h2>
                    <h3 class="section-subheading text-muted">Digitalización sencilla y asistencia por IA diseñadas para pequeños negocios y comercios locales.</h3>
                </div>
                <div class="row text-center">
                    @foreach ($services as $service)
                        <div class="col-md-4">
                            <span class="fa-stack fa-4x">
                                <i class="fas fa-circle fa-stack-2x text-primary"></i>
                                <i class="fas {{ $service['icon'] }} fa-stack-1x fa-inverse"></i>
                            </span>
                            <h4 class="my-3">{{ $service['title'] }}</h4>
                            <p class="text-muted">{{ $service['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Portfolio / Propuesta de valor Grid-->
        @php
            $pillars = [
                [
                    'id' => 'portfolioModal1',
                    'image' => 'assets/img/portfolio/1.png',
                    'title' => 'Presencia Física',
                    'subtitle' => 'Asistencia en tu local',
                    'intro' => 'Nos desplazamos a tu establecimiento para conocer tus necesidades de primera mano.',
                    'details' => 'Un asistente de NovaTech acude en persona a tu negocio, escucha qué necesitas, explica el proceso de digitalización de la forma más clara posible y deja todo funcionando para que no te quedes bloqueado.',
                    'service' => 'Visita Presencial y Diagnóstico',
                    'benefit' => 'Trato cercano adaptado a tu comercio',
                ],
                [
                    'id' => 'portfolioModal2',
                    'image' => 'assets/img/portfolio/2.png',
                    'title' => 'Cero Curva de Aprendizaje',
                    'subtitle' => 'Consultas por voz o texto',
                    'intro' => 'Tu negocio te responde con frases cotidianas, sin paneles complejos.',
                    'details' => 'Con Business Copilot puedes preguntar por voz o con frases normales como «¿cuánto he vendido hoy?» o «¿cuánto dinero he gastado este mes?» y obtener respuestas claras al instante sin necesidad de aprender a manejar interfaces técnicas.',
                    'service' => 'Business Copilot (Agente IA)',
                    'benefit' => 'Sin conocimientos tecnológicos previos',
                ],
                [
                    'id' => 'portfolioModal3',
                    'image' => 'assets/img/portfolio/3.png',
                    'title' => 'Acompañamiento con Salida',
                    'subtitle' => 'Formación práctica y autonomía',
                    'intro' => 'Te enseñamos a gestionar tu negocio digital en lugar de crear dependencia permanente.',
                    'details' => 'Nuestro programa funciona mediante suscripción flexible durante el tiempo que necesites. Te formamos paso a paso para que aprendas a actualizar tu página web y usar tus herramientas digitales con total autonomía.',
                    'service' => 'Digitaliza Fácil · Formación',
                    'benefit' => 'Control total de tu web y herramientas',
                ],
                [
                    'id' => 'portfolioModal4',
                    'image' => 'assets/img/portfolio/4.png',
                    'title' => 'Privacidad Garantizada',
                    'subtitle' => 'Servidor propio y seguridad',
                    'intro' => 'Tus datos financieros y administrativos siempre protegidos y accesibles.',
                    'details' => 'A diferencia de las IAs generales, garantizamos la privacidad de los datos financieros y administrativos de tu empresa y te proporcionamos un espacio dedicado en servidor para acceder a tus recursos digitales sin problemas.',
                    'service' => 'Infraestructura y Privacidad',
                    'benefit' => 'Datos aislados y bajo tu control',
                ],
                [
                    'id' => 'portfolioModal5',
                    'image' => 'assets/img/portfolio/5.png',
                    'title' => 'Web y Automatización',
                    'subtitle' => 'Digitaliza Fácil',
                    'intro' => 'La puerta de entrada para modernizar tu negocio desde cero.',
                    'details' => 'Creamos una página web sencilla y profesional, instalamos las herramientas digitales adecuadas y automatizamos tareas repetitivas y manuales (facturas, control de stock o pedidos) para ahorrarte tiempo cada día.',
                    'service' => 'Digitaliza Fácil · Implementación',
                    'benefit' => 'Más visibilidad y menos trabajo manual',
                ],
                [
                    'id' => 'portfolioModal6',
                    'image' => 'assets/img/portfolio/6.png',
                    'title' => 'Gestión de Stock y Caja',
                    'subtitle' => 'Decisiones con datos claros',
                    'intro' => 'Centraliza ventas, gastos, inventario y clientes en un mismo lugar.',
                    'details' => 'Una vez digitalizados los datos de tu negocio, Business Copilot te ayuda a interpretar tus números y administrar de forma eficiente el stock y la administración diaria para que tu comercio sea más rentable y competitivo.',
                    'service' => 'Business Copilot · Gestión',
                    'benefit' => 'Control real de ingresos, gastos y stock',
                ],
            ];
        @endphp
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Propuesta de Valor</h2>
                    <h3 class="section-subheading text-muted">Nos diferenciamos de las IAs generales combinando trato presencial, formación y herramientas adaptadas.</h3>
                </div>
                <div class="row">
                    @foreach ($pillars as $index => $pillar)
                        <div class="col-lg-4 col-sm-6 {{ $index < 3 ? 'mb-4' : ($index < 5 ? 'mb-4 mb-lg-0' : '') }}">
                            <div class="portfolio-item">
                                <a class="portfolio-link" data-bs-toggle="modal" href="#{{ $pillar['id'] }}">
                                    <div class="portfolio-hover">
                                        <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                    </div>
                                    <img class="img-fluid" src="{{ asset($pillar['image']) }}" alt="{{ $pillar['title'] }}" />
                                </a>
                                <div class="portfolio-caption">
                                    <div class="portfolio-caption-heading">{{ $pillar['title'] }}</div>
                                    <div class="portfolio-caption-subheading text-muted">{{ $pillar['subtitle'] }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- About / Recorrido del cliente-->
        <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Recorrido del Cliente</h2>
                    <h3 class="section-subheading text-muted">Nuestros dos servicios son fases de un mismo camino hacia tu autonomía digital.</h3>
                </div>
                <ul class="timeline">
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{ asset('assets/img/about/1.jpg') }}" alt="Visita presencial" /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Fase 1</h4>
                                <h4 class="subheading">Visita presencial</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Visitamos tu establecimiento para entender tu negocio de primera mano, escuchar tus objetivos y recomendarte las soluciones más sencillas para tu caso.</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{ asset('assets/img/about/2.jpg') }}" alt="Digitalización Fácil" /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Fase 2</h4>
                                <h4 class="subheading">Digitalización Fácil</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Creamos tu página web, instalamos tus herramientas digitales, automatizamos tareas repetitivas e impartimos formación básica. Es la puerta de entrada imprescindible.</p></div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{ asset('assets/img/about/3.jpg') }}" alt="Business Copilot" /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Fase 3</h4>
                                <h4 class="subheading">Business Copilot (Agente IA)</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Con los datos del negocio ya digitalizados, activamos tu asistente de IA para que consultes ventas, gastos y stock mediante preguntas cotidianas por texto o voz.</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{ asset('assets/img/about/4.jpg') }}" alt="Suscripción de seguimiento" /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Fase 4</h4>
                                <h4 class="subheading">Suscripción de seguimiento</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Realizamos reuniones remotas periódicas, comprobamos avances y aplicamos mejoras continuas durante los meses que necesites hasta que domines el sistema.</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>
                                Tu Negocio
                                <br />
                                Habla
                                <br />
                                Claro!
                            </h4>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <!-- Team-->
        @php
            $team = [
                [
                    'image' => 'assets/img/team/1.jpg',
                    'name' => 'Raúl Gorlat Castro',
                    'role' => 'Asistente en Programación y Web',
                ],
                [
                    'image' => 'assets/img/team/2.jpg',
                    'name' => 'Adrián Burgos Tomé',
                    'role' => 'Asistente en Sistemas y Agente IA',
                ],
                [
                    'image' => 'assets/img/team/3.jpg',
                    'name' => 'José Sánchez Sorroche',
                    'role' => 'Asistente en Automatización y Formación',
                ],
            ];
        @endphp
        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Nuestro Equipo</h2>
                    <h3 class="section-subheading text-muted">Asistentes con formación en programación dedicados a orientar, asesorar y acompañar a cada cliente.</h3>
                </div>
                <div class="row">
                    @foreach ($team as $member)
                        <div class="col-lg-4">
                            <div class="team-member">
                                <img class="mx-auto rounded-circle" src="{{ asset($member['image']) }}?v={{ filemtime(public_path($member['image'])) }}" alt="{{ $member['name'] }}" />
                                <h4>{{ $member['name'] }}</h4>
                                <p class="text-muted">{{ $member['role'] }}</p>
                                <a class="btn btn-dark btn-social mx-2" href="#contact" aria-label="{{ $member['name'] }} Twitter"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-dark btn-social mx-2" href="#contact" aria-label="{{ $member['name'] }} Facebook"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-dark btn-social mx-2" href="#contact" aria-label="{{ $member['name'] }} LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center">
                        <p class="large text-muted">
                            «Tu socio digital de confianza: te acompañamos en persona y tu negocio te habla claro.»
                            Aprovecha todas las ventajas digitales sin aprender interfaces complejas gracias a nuestra asistencia presencial, formativa y por voz.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Contacto</h2>
                    <h3 class="section-subheading text-muted">Solicita una visita presencial para analizar las necesidades de tu negocio.</h3>
                </div>
                <form id="contactForm" action="{{ route('contact.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Tu nombre *" maxlength="120" required />
                                <div class="invalid-feedback" data-default-error="Por favor, introduce tu nombre.">@error('name'){{ $message }}@else Por favor, introduce tu nombre. @enderror</div>
                            </div>
                            <div class="form-group">
                                <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Tu correo electrónico *" maxlength="190" required />
                                <div class="invalid-feedback" data-default-error="Introduce un correo electrónico válido.">@error('email'){{ $message }}@else Introduce un correo electrónico válido. @enderror</div>
                            </div>
                            <div class="form-group mb-md-0">
                                <input class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" type="tel" value="{{ old('phone') }}" placeholder="Tu teléfono *" maxlength="40" required />
                                <div class="invalid-feedback" data-default-error="Por favor, introduce tu teléfono de contacto.">@error('phone'){{ $message }}@else Por favor, introduce tu teléfono de contacto. @enderror</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" placeholder="Cuéntanos sobre tu negocio y qué te gustaría mejorar *" minlength="10" maxlength="2000" required>{{ old('message') }}</textarea>
                                <div class="invalid-feedback" data-default-error="Por favor, escribe un breve mensaje (mínimo 10 caracteres).">@error('message'){{ $message }}@else Por favor, escribe un breve mensaje (mínimo 10 caracteres). @enderror</div>
                            </div>
                        </div>
                    </div>
                    <div class="{{ session('contact_success') ? '' : 'd-none' }}" id="submitSuccessMessage">
                        <div class="text-center text-white mb-3">
                            <div class="fw-bolder">¡Solicitud registrada!</div>
                            <span id="submitSuccessText">{{ session('contact_success', 'Un asistente de NovaTech se pondrá en contacto contigo para concertar la visita presencial.') }}</span>
                        </div>
                    </div>
                    <div class="d-none" id="submitErrorMessage">
                        <div class="text-center text-danger mb-3" id="submitErrorText">No se pudo enviar la solicitud. Revisa los campos e inténtalo de nuevo.</div>
                    </div>
                    <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase" id="submitButton" type="submit">Solicitar visita</button></div>
                </form>
            </div>
        </section>

        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy; NovaTech {{ date('Y') }}</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#contact" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#contact" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#contact" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#portfolioModal4" data-bs-toggle="modal">Privacidad</a>
                        <a class="link-dark text-decoration-none" href="#services">Servicios</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Portfolio Modals-->
        @foreach ($pillars as $pillar)
            <div class="portfolio-modal modal fade" id="{{ $pillar['id'] }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="close-modal" data-bs-dismiss="modal"><img src="{{ asset('assets/img/close-icon.svg') }}" alt="Cerrar modal" /></div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="modal-body">
                                        <h2 class="text-uppercase">{{ $pillar['title'] }}</h2>
                                        <p class="item-intro text-muted">{{ $pillar['intro'] }}</p>
                                        <img class="img-fluid d-block mx-auto" src="{{ asset($pillar['image']) }}" alt="{{ $pillar['title'] }}" />
                                        <p>{{ $pillar['details'] }}</p>
                                        <ul class="list-inline">
                                            <li>
                                                <strong>Área:</strong>
                                                {{ $pillar['service'] }}
                                            </li>
                                            <li>
                                                <strong>Beneficio:</strong>
                                                {{ $pillar['benefit'] }}
                                            </li>
                                        </ul>
                                        <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                            <i class="fas fa-xmark me-1"></i>
                                            Cerrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>
