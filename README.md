--env=test

curl -X POST -H "Content-Type: application/json" http://127.0.0.1:8001/api/v1/auth/login --data {\"username\":\"johndoe\",\"password\":\"testtest\"}
curl "http://127.0.0.1:8001/api/v1/user/me" -H 'Authorization: Bearer '


curl -X POST -H "Content-Type: application/json" http://127.0.0.1:8001/api/v1/auth/refresh --data {\"refresh_token\":\"fe8e5c84255e589e616dc04efbc8d13456fe486395fcc56de75d1e4a38fa4a598a9fb6db0f396d74c3ee927ab00a92d9cbb1681ad09263a6b9c2a28d59f4bb92\"}


php bin/console gesdinet:jwt:clear
удаление команды(нужно делать Азату)
