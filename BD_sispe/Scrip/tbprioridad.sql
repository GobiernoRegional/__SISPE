--INSERTAR
CREATE OR REPLACE FUNCTION fn_prioridadinsertar(
    nombre character varying, eje character)
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
		values(Codigo,nombre,eje);
		end;
  $BODY$
  LANGUAGE plpgsql;


--UPDATE
CREATE OR REPLACE FUNCTION fn_prioridadmodificar(
    pricodigo character,
    nombre character varying,
    eje character)
  RETURNS void AS
$BODY$
	  declare	
	  begin
	
		update 
			tbprioridad
		set 
			pri_nombre = nombre,
			pri_eje_codigo = eje
		where 
			pri_codigo  = pricodigo;
		end;
  $BODY$
  LANGUAGE plpgsql;
  
--select fn_prioridadinsertar('ABCDFS');
--select fn_prioridadmodificar('POL001','rteerASA');

--select * from tbprioridad