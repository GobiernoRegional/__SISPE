CREATE OR REPLACE FUNCTION fn_insertarPlanDesarrollo(
    titulo character varying,
    descripcion character varying)
  RETURNS void AS
$BODY$
	  declare
		codigo character(6);
		cantidad integer;		
	  begin
		select count(*) into Cantidad from tbplandesarrollo;			

		IF Cantidad = 0 then
		Codigo = 'PLN001';

		ELSE
		select max(pde_codigo) into Codigo from tbplandesarrollo;

		Codigo = 'PLN' || Right('000'|| Cast(right(Codigo,3) as int) + 1,3);
		END IF;

		insert into tbplandesarrollo(pde_codigo,pde_titulo,pde_descripcion)
		values(Codigo,titulo,descripcion);
	  end;
  $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION fn_insertarPlanDesarrollo(character varying, character varying)
  OWNER TO postgres;

select fn_insertarPlanDesarrollo('Plan Operativo Institucional','Plan Operativo Institucional del Gobierno Regional Lambayeque');

CREATE OR REPLACE FUNCTION fn_insertarCapitulo(
    nombre character varying,
    pland character)
  RETURNS void AS
$BODY$
	  declare
		codigo character(6);
		cantidad integer;		
	  begin
		select count(*) into Cantidad from tbcapitulo;			

		IF Cantidad = 0 then
		Codigo = 'CAP001';

		ELSE
		select max(cap_codigo) into Codigo from tbcapitulo;

		Codigo = 'CAP' || Right('000'|| Cast(right(Codigo,3) as int) + 1,3);
		END IF;

		insert into tbcapitulo(cap_codigo,cap_nombre,cap_pdn_codigo)
		values(Codigo,nombre,pland);
	  end;
  $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION fn_insertarCapitulo(character varying, character)
  OWNER TO postgres;

select fn_insertarCapitulo('FASE II','PLN001');

CREATE OR REPLACE FUNCTION fn_insertarSubCapitulo(
    nombre character varying,
    capitulo character)
  RETURNS void AS
$BODY$
	  declare
		codigo character(6);
		cantidad integer;		
	  begin
		select count(*) into Cantidad from tbsubcapitulos;			

		IF Cantidad = 0 then
		Codigo = 'SCP001';

		ELSE
		select max(sub_codigo) into Codigo from tbsubcapitulos;

		Codigo = 'SCP' || Right('000'|| Cast(right(Codigo,3) as int) + 1,3);
		END IF;

		insert into tbsubcapitulos(sub_codigo,sub_nombre,sub_cap_codigo)
		values(Codigo,nombre,capitulo);
	  end;
  $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION fn_insertarSubCapitulo(character varying, character)
  OWNER TO postgres;

select fn_insertarSubCapitulo('Eje Estratégico I','CAP001');

CREATE OR REPLACE FUNCTION fn_insertarEjeEstrategico(
    nombre character varying,
    subcapitulo character)
  RETURNS void AS
$BODY$
	  declare
		codigo character(6);
		cantidad integer;		
	  begin
		select count(*) into Cantidad from tbejeestrategico;			

		IF Cantidad = 0 then
		Codigo = 'EJE001';

		ELSE
		select max(eje_codigo) into Codigo from tbejeestrategico;

		Codigo = 'EJE' || Right('000'|| Cast(right(Codigo,3) as int) + 1,3);
		END IF;

		insert into tbejeestrategico(eje_codigo,eje_nombre,eje_sub_codigo)
		values(Codigo,nombre,subcapitulo);
	  end;
  $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION fn_insertarEjeEstrategico(character varying, character)
  OWNER TO postgres;

select fn_insertarEjeEstrategico('Derechos fundamentales y dignidad de las personas','SCP001');

CREATE OR REPLACE FUNCTION fn_insertarObjetivoNacional(
    nombre character varying,
    descripcion character varying,
    eje character)
  RETURNS void AS
$BODY$
	  declare
		codigo character(6);
		cantidad integer;		
	  begin
		select count(*) into Cantidad from tbobjetivo_nacional;			

		IF Cantidad = 0 then
		Codigo = 'ONA001';

		ELSE
		select max(ona_codigo) into Codigo from tbobjetivo_nacional;

		Codigo = 'ONA' || Right('000'|| Cast(right(Codigo,3) as int) + 1,3);
		END IF;

		insert into tbobjetivo_nacional(ona_codigo,ona_nombre,ona_descripcion,ona_eje_codigo)
		values(Codigo,nombre,descripcion, eje);
	  end;
  $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION fn_insertarObjetivoNacional(character varying, character varying, character)
  OWNER TO postgres;

select fn_insertarObjetivoNacional('Plena vigencia de los derechos fundamentales y de la dignidad de las personas','Este objetivo involucra la plena democratización de la sociedad y la vigencia irrestricta del derecho a la vida, a la dignidad de las personas, a la identidad e integridad, a la no discriminación, al respeto de la diversidad cultural y al libre desarrollo y bienestar de todos los ciudadanos, conforme a lo dispuesto en la Constitución y en los tratados internacionales de derechos humanos.','EJE001');

CREATE OR REPLACE FUNCTION fn_insertarPrioridad(
    nombre character varying,
    eje character)
  RETURNS void AS
$BODY$
	  declare
		codigo character(6);
		cantidad integer;		
	  begin
		select count(*) into Cantidad from tbprioridad;			

		IF Cantidad = 0 then
		Codigo = 'PRI001';

		ELSE
		select max(pri_codigo) into Codigo from tbprioridad;

		Codigo = 'PRI' || Right('000'|| Cast(right(Codigo,3) as int) + 1,3);
		END IF;

		insert into tbprioridad(pri_codigo,pri_nombre,pri_eje_codigo)
		values(Codigo,nombre, eje);
	  end;
  $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION fn_insertarPrioridad(character varying, character)
  OWNER TO postgres;

select fn_insertarPrioridad('Asegurar la vigencia plena de los derechos fundamentales.','EJE001');

CREATE OR REPLACE FUNCTION fn_insertarObjetivoEspecifico(
    nombre character varying,
    eje character)
  RETURNS void AS
$BODY$
	  declare
		codigo character(6);
		cantidad integer;		
	  begin
		select count(*) into Cantidad from tbobjetivo_especifico;			

		IF Cantidad = 0 then
		Codigo = 'OES001';

		ELSE
		select max(oes_codigo) into Codigo from tbobjetivo_especifico;

		Codigo = 'OES' || Right('000'|| Cast(right(Codigo,3) as int) + 1,3);
		END IF;

		insert into tbobjetivo_especifico(oes_codigo,oes_nombre,oes_nej_codigo)
		values(Codigo,nombre, eje);
	  end;
  $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION fn_insertarObjetivoEspecifico(character varying, character)
  OWNER TO postgres;

select fn_insertarObjetivoEspecifico('Vigencia plena y efectiva de los derechos y libertades fundamentales','EJE001');
