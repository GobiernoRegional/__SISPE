--INSERTAR
CREATE OR REPLACE FUNCTION fn_politicalineamientoinsertar(
	nombre character varying,
       descripcion character varying,
       eje character)
  RETURNS void AS
$BODY$
	  declare
		codigo character(6);
		cantidad integer;		
	  begin
		select count(*) into Cantidad from tbpolitica_liniamiento;			

		IF Cantidad = 0 then
		Codigo = 'PLI001';

		ELSE
		select max(pli_codigo) into Codigo from tbpolitica_liniamiento;

		Codigo = 'PLI' || Right('000'|| Cast(right(Codigo,3) as int) + 1,3);
		END IF;

		insert into tbpolitica_liniamiento(pli_codigo,pli_nombre,pli_descripcion,pli_eje_codigo)
		values(Codigo,nombre,descripcion,eje);
		end;
  $BODY$
  LANGUAGE plpgsql;


--UPDATE
CREATE OR REPLACE FUNCTION fn_politicalineamientoinsertarmodificar(
    plicodigo character,
    nombre character varying,
    descripcion character varying,
    eje character)
  RETURNS void AS
$BODY$
	  declare	
	  begin
	
		update 
			tbpolitica_liniamiento
		set 
			pli_nombre = nombre,
			pli_descripcion = descripcion,
			pli_eje_codigo = eje 
		where 
			pli_codigo  = plicodigo;
		end;
  $BODY$
  LANGUAGE plpgsql;

  --ELIMINAR
CREATE OR REPLACE FUNCTION fn_politicalineamientoeliminar(
    plicodigo character)
  RETURNS void AS
$BODY$
	declare				
	begin
		delete from tbpolitica_liniamiento
		where pli_codigo = plicodigo;
	end;
  $BODY$
  LANGUAGE plpgsql;
  
--select fn_politicalineamientoinsertar('ABCDFS','KKKSLKSAS',NULL);
--select fn_politicalineamientoinsertarmodificar('PLI001','rteerASA','KKKSLKSAS',NULL);
--select fn_politicalineamientoeliminar('PLI001');

--select * from tbpolitica_liniamiento
