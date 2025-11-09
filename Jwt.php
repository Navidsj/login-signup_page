<?php

class Jwt{

    private $secret_key = "a testing secret key";

    public function encode(array $payload): string{
        $header = json_encode([
            "alg" => "HS256",
            "typ" => "JWT"
        ]);

        $header = base64_encode($header);
        $payload = json_encode($payload);
        $payload = base64_encode($payload);

        $signature = hash_hmac("sha256", $header . "." . $payload, $this->secret_key, true);
        $signature = base64_encode($signature);
        return $header . "." . $payload . "." . $signature;
    }

    public function decode(string $token): array
    {
        if (
            preg_match(
                "/^(?<header>.+)\.(?<payload>.+)\.(?<signature>.+)$/",
                $token,
                $matches
            ) !== 1
        ) {

            throw new InvalidArgumentException("invalid token format");
        }

        $signature = hash_hmac(
            "sha256",
            $matches["header"] . "." . $matches["payload"],
            $this->secret_key,
            true
        );

        $signature_from_token = base64_decode($matches["signature"]);

        if (!hash_equals($signature, $signature_from_token)) {
            throw new InvalidArgumentException("invalid token format");
        }

        $payload = json_decode(base64_decode($matches["payload"]), true);

        return $payload;
    }



}
