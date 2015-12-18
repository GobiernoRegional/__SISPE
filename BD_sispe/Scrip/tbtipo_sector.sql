--INSERTAR
CREATE OR REPLACE FUNCTION fn_sectorinsertar(
    nombre character,
    politica character,
    estrategia character,
    objetivo character,
    eje character)
  RETURNS void AS
$BODY$
	  declare
		codigo character(6);
		cantidad integer;		
	  begin
		select count(*) into Cantidad from tbtipo_sector;			

		IF Cantidad = 0 then
		Codigo = 'TSE001';

		ELSE
		select max(tse_codigo) into Codigo from tbtipo_sector;

		Codigo = 'TSE' || Right('000'|| Cast(right(Codigo,3) as int) + 1,3);
		END IF;

		insert into tbtipo_sector(tse_codigo,tse_nombre,tse_pol_codigo,tse_est_codigo,tse_oes_codigo,tse_eje_codigo)
		values(Codigo,nombre,politica,estrategia,objetivo,eje);
		end;
  $BODY$
  LANGUAGE plpgsql;


--UPDATE
CREATE OR REPLACE FUNCTION fn_sectormodificar(
    codigo character,
    nombre character,
    politica character,
    estrategia character,
    objetivo character,
    eje character)
  RETURNS void AS
$BODY$
	  declare	
	  begin
	
		update 
			tbtipo_sector
		set 
			tse_nombre   	= nombre,
			tse_pol_codigo 	= politica,
			tse_est_codigo 	= estrategia,
			tse_oes_codigo	= objetivo,
			tse_eje_codigo 	= eje
		where 
			tse_codigo  = codigo;
		end;
  $BODY$
  LANGUAGE plpgsql;

  
--select fn_sectorinsertar('ABCDA',null,null,null,null);
--select fn_sectormodificar('TSE001','2013',null,null,null,null);

--select * from tbtipo_sector
--delete from tbtipo_sector where tse_codigo = 'VAR002'