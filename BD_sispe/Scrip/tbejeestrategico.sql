--INSERTAR
CREATE OR REPLACE FUNCTION fn_ejeestrategicoinsertar(
    nombre character varying,
    subcodigo character)
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
		values(Codigo,nombre,subcodigo);
		end;
  $BODY$
  LANGUAGE plpgsql;


--UPDATE
CREATE OR REPLACE FUNCTION fn_ejeestrategicomodificar(
    capcodigo character,
    nombre character varying,
    subcodigo character)
  RETURNS void AS
$BODY$
	  declare	
	  begin
	
		update 
			tbejeestrategico
		set 
			eje_nombre = nombre,
			eje_sub_codigo = subcodigo
		where 
			eje_codigo  = capcodigo;
		end;
  $BODY$
  LANGUAGE plpgsql;

  --ELIMINAR
CREATE OR REPLACE FUNCTION fn_ejeestrategicoeliminar(
    subcodigo character)
  RETURNS void AS
$BODY$
	declare				
	begin
		delete from tbejeestrategico
		where eje_codigo = subcodigo;
	end;
  $BODY$
  LANGUAGE plpgsql;
  
--select fn_ejeestrategicoinsertar('Gobernabilidad y Gestión Pública','SUB004');
--select fn_ejeestrategicomodificar('EJE004','Gobernabilidad y Gestión ZX<ZX','SUB004');
--select fn_ejeestrategicoeliminar('EJE005');
--select * from tbejeestrategico