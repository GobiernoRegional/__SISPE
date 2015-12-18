--INSERTAR
CREATE OR REPLACE FUNCTION fn_accioninsertar(
    descripcion character varying, objetivo character)
  RETURNS void AS
$BODY$
	  declare
		codigo character(6);
		cantidad integer;		
	  begin
		select count(*) into Cantidad from tbaccion;			

		IF Cantidad = 0 then
		Codigo = 'ACC001';

		ELSE
		select max(acc_codigo) into Codigo from tbaccion;

		Codigo = 'ACC' || Right('000'|| Cast(right(Codigo,3) as int) + 1,3);
		END IF;

		insert into tbaccion(acc_codigo,acc_descripcion,acc_obj_codigo)
		values(Codigo,descripcion,objetivo);
		end;
  $BODY$
  LANGUAGE plpgsql;


--UPDATE
CREATE OR REPLACE FUNCTION fn_accionmodificar(
    codigo character,
    descripcion character varying,
    objetivo character)
  RETURNS void AS
$BODY$
	  declare	
	  begin
	
		update 
			tbaccion
		set 
			acc_descripcion = descripcion,
			acc_obj_codigo = objetivo
		where 
			acc_codigo  = codigo;
		end;
  $BODY$
  LANGUAGE plpgsql;
  
--select fn_accioninsertar('ABCDFS','');
--select fn_accionmodificar('POL001','rteerASA','');

--select * from tbaccion
--delete from tbaccion where acc_codigo = 'VAR002'