

# GET - Motivo - Consulta Completa
curl --location 'http://localhost:90/projeto/end_points/tabela_motivo.php' \
--header 'Authorization: Basic 6a252df1158442ef45f350938e53253b9a043eb3cb27e05ff5171d469c4c'

# GET - Motivo - Consulta por ID
curl --location 'http://localhost:90/projeto/end_points/tabela_motivo.php?id=17' \
--header 'Authorization: Basic 6a252df1158442ef45f350938e53253b9a043eb3cb27e05ff5171d469c4c'

# PUT - Motivo - Edição
curl --location --request PUT 'http://localhost:90/projeto/end_points/tabela_motivo.php' \
--header 'Authorization: Basic 6a252df1158442ef45f350938e53253b9a043eb3cb27e05ff5171d469c4c' \
--header 'Content-Type: application/json' \
--data '{
    "id": "35",
    "descricao": "teste 2"
}'

# POST - Motivo - Gravar Registro
curl --location 'http://localhost:90/projeto/end_points/tabela_motivo.php' \
--header 'Authorization: Basic 6a252df1158442ef45f350938e53253b9a043eb3cb27e05ff5171d469c4c' \
--header 'Content-Type: application/json' \
--data '{
    "descricao": "eweweew"
}'

# DEL - Motivo - Excluir Registro
curl --location --request DELETE 'http://localhost:90/projeto/end_points/tabela_motivo.php' \
--header 'Authorization: Basic 6a252df1158442ef45f350938e53253b9a043eb3cb27e05ff5171d469c4c' \
--header 'Content-Type: application/json' \
--data '{
    "id": 37
}'
