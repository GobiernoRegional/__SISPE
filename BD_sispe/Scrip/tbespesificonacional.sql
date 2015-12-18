--INSERTAR
CREATE OR REPLACE FUNCTION fn_objetivonacionalinsertar(
    nombre character varying,
    ejecodigo character)
  RETURNS void AS
$BODY$
	  declare
		codigo character(6);
		cantidad integer;		
	  begin
		select count(*) into Cantidad from tbobjetivo_especificonacional;			

		IF Cantidad = 0 then
		Codigo = 'OES001';

		ELSE
		select max(oen_codigo) into Codigo from tbobjetivo_especificonacional;

		Codigo = 'OES' || Right('000'|| Cast(right(Codigo,3) as int) + 1,3);
		END IF;

		insert into tbobjetivo_especificonacional(oen_codigo,oen_nombre,oen_eje_codigo)
		values(Codigo,nombre,ejecodigo);
		end;
  $BODY$
  LANGUAGE plpgsql;


--UPDATE
CREATE OR REPLACE FUNCTION fn_objetivonacionalmodificar(
    oescodigo character,
    nombre character varying,
    ejecodigo character)
  RETURNS void AS
$BODY$
	  declare	
	  begin
	
		update 
			tbobjetivo_especificonacional
		set 
			oen_nombre = nombre,
			oen_eje_codigo = ejecodigo
		where 
			oen_codigo  = oescodigo;
		end;
  $BODY$
  LANGUAGE plpgsql;

  --ELIMINAR
CREATE OR REPLACE FUNCTION fn_objetivonacionaleliminar(
    oescodigo character)
  RETURNS void AS
$BODY$
	declare				
	begin
		delete from tbobjetivo_especificonacional
		where oen_codigo = oescodigo;
	end;
  $BODY$
  LANGUAGE plpgsql;
  
--select fn_objetivonacionalinsertar('rteer','EJE001');
--select fn_objetivonacionalmodificar('OES001','rteerASA','EJE001');
--select fn_objetivonacionaleliminar('OES001');
--select * from tbobjetivo_especifico