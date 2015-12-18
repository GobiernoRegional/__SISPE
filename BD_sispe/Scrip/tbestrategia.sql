--INSERTAR
CREATE OR REPLACE FUNCTION fn_estrategiainsertar(
    descripcion character varying)
  RETURNS void AS
$BODY$
	  declare
		codigo character(6);
		cantidad integer;		
	  begin
		select count(*) into Cantidad from tbestrategia;			

		IF Cantidad = 0 then
		Codigo = 'EST001';

		ELSE
		select max(est_codigo) into Codigo from tbestrategia;

		Codigo = 'EST' || Right('000'|| Cast(right(Codigo,3) as int) + 1,3);
		END IF;

		insert into tbestrategia(est_codigo,est_descripcion)
		values(Codigo,descripcion);
		end;
  $BODY$
  LANGUAGE plpgsql;


--UPDATE
CREATE OR REPLACE FUNCTION fn_estrategiamodificar(
    codigo character,
    descripcion character varying)
  RETURNS void AS
$BODY$
	  declare	
	  begin
	
		update 
			tbestrategia
		set 
			est_descripcion = descripcion
		where 
			est_codigo  = codigo;
		end;
  $BODY$
  LANGUAGE plpgsql;

  
--select fn_estrategiainsertar('ABCDFS');
--select fn_estrategiamodificar('EST001','rteerASA');

--select * from tbestrategia
--delete from tbestrategia where est_codigo = 'VAR002'