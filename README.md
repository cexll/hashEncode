# 使用 rsa + aes 加密接口数据

安装
```bash
composer require cexll/hash-encode
```

思路
```bash
加密
    rsa 用于加密(key) --- 随机生成的key
    aes 用于加密(body) --- 接口数据 
    得到
    {
      "body": 加密的数据,
      "key": 加密的key
    }
解密
    rsa 使用公钥解密, 得到随机生成的key
    aes 使用解密到的key, 来解密body 数据, 得到 接口数据
```




```php
function hash($data): array
{
    # 设置rsa 公钥 密钥
    hashEncode::setPrivateKeyPath('path');
    #hashEncode::setPublicKeyPath('path'); 这里可以不用公钥地址, 因为只加密不解密 
    
    # 加密
    return hashEncode::hash_encode(json_encode($data, JSON_UNESCAPED_UNICODE));
}

```

得到结果类似
```json
{
  "body": "78eqOhxERE2unQRBr4d\/6hGmlDqMofEoZGBt5aPnp3ATRMkGh92z\/zkdNKFW9RkbMx0jShaKJoX+7cMAGkqy\/xn4AbiUjVgl8aNqFqgPEE1PBM+1FImxYcy1zUb25gvhRZ28oRuMAm+9XJ96o7YU4iedy7ZL8PwP22uXQN3BGtrklf\/6coCRfgxKFy2RSJ70rF0trgs47xTRcki8cVruAtMf2KlDTMQwAMXkEfOZEU9nBxfaxoX\/leVRm8L9wxn1y2FUEnS4p5dJN7hmCaTK8Ge++7eVZP7OjOlkSJrzyClp9oRQgDFhAJR6JPoC8yMR1+9hOqRS0ypTxdgEXgsE8eX4sid2qYla\/H98q1oXDxM=",
  "key": "AIxbXOhYR8VCyxldvOUM92IeThudbxjbWWpo9zpVkxjSuI23PkP7qf4BF9qxmUNv1PXpTYUJECym+bQkTvjnMufYWYocBRm2KfiaOuK\/SznFW+tJGEuIG3KftZFud2JFv1ELCdgauLAHnSzyPXQ47at3WE12e8iNJ6moK8q9sJI="
}
```




