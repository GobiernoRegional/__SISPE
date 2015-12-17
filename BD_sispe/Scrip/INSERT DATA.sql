--PLAN DE DESARROLLO
insert into tbplandesarrollo values('PDE001','Plan Estratégico de Desarrollo Nacional','null');
insert into tbplandesarrollo values('PDE002','Plan Estratégico de Desarrollo Regional Concertado de Lambayeque','null');

--CAPITULOS
insert into tbcapitulo values('CAP001','I. FUNDAMENTO NORMATIVO Y METODOLOGICO','PDE002');
insert into tbcapitulo values('CAP002','II. EVOLUCIÓN HISTÓRICA DE LAMBAYEQUE','PDE002');
insert into tbcapitulo values('CAP003','III. DIAGNOSTICO TERRITORIAL DEL DEPARTAMENTO DE LAMBAYEQUE','PDE002');
insert into tbcapitulo values('CAP004','IV. LAMBAYEQUE EN EL CONTEXTO MACROREGIONAL, NACIONAL E INTERNACIONAL','PDE002');
insert into tbcapitulo values('CAP005','V. ESTRATEGIAS DE DESARROLLO REGIONAL','PDE002');
insert into tbcapitulo values('CAP006','VI. INSTITUCIONALIDAD DEL PLAN DE DESARROLLO REGIONAL CONCERTADO','PDE002');
insert into tbcapitulo values('CAP007','VII. PROGRAMA MULTIANUAL DE INVERSIÓN PÚBLICA 2011-2014','PDE002');

--SUBCAPITULO
insert into tbsubcapitulos values('SUB001','5.1 Visión Concertada de Lambayeque al 2021','CAP005');
insert into tbsubcapitulos values('SUB002','5.2 Enfoque de Desarrollo','CAP005');
insert into tbsubcapitulos values('SUB003','5.3 Vocación Productiva y Sectores Prioritarios','CAP005');
insert into tbsubcapitulos values('SUB004','5.4 Ejes Estratégicos de Intervención','CAP005'); 

--EJES
insert into tbejeestrategico values ('EJE001','Inclusión e Integración Socio Cultural y Acceso a Servicios Sociales Básicos','SUB004');


