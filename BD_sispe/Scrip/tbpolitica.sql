--INSERTAR
CREATE OR REPLACE FUNCTION fn_politicainsertar(
    descripcion character varying)
  RETURNS void AS
$BODY$
	  declare
		codigo character(6);
		cantidad integer;		
	  begin
		select count(*) into Cantidad from tbpolitica;			

		IF Cantidad = 0 then
		Codigo = 'POL001';

		ELSE
		select max(pol_codigo) into Codigo from tbpolitica;

		Codigo = 'POL' || Right('000'|| Cast(right(Codigo,3) as int) + 1,3);
		END IF;

		insert into tbpolitica(pol_codigo,pol_descripcion)
		values(Codigo,descripcion);
		end;
  $BODY$
  LANGUAGE plpgsql;


--UPDATE
CREATE OR REPLACE FUNCTION fn_politicamodificar(
    polcodigo character,
    descripcion character varying)
  RETURNS void AS
$BODY$
	  declare	
	  begin
	
		update 
			tbpolitica
		set 
			pol_descripcion = descripcion
		where 
			pol_codigo  = polcodigo;
		end;
  $BODY$
  LANGUAGE plpgsql;

  --ELIMINAR
CREATE OR REPLACE FUNCTION fn_politicaeliminar(
    polcodigo character)
  RETURNS void AS
$BODY$
	declare				
	begin
		delete from tbpolitica
		where pol_codigo = polcodigo;
	end;
  $BODY$
  LANGUAGE plpgsql;
  
--select fn_politicainsertar('ABCDFS');
--select fn_politicamodificar('POL001','rteerASA');
--select fn_politicaeliminar('POL001');

--select * from tbpolitica