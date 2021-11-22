# Lara iFood

Integre seu sistema rapidamente com o iFood através deste pacote.


## Instalando

Instale com [composer](https://getcomposer.org/):

```bash
composer require bee-delivery/laraifood
```

## Authentication OAuth
Issues a user code to link applications in Partner Portal and grant them permissions to access merchant resources

```php
$response = LaraiFood::auth()->getUserCode();
```
> Example of response
```php
[
  "code" => 200
  "response" => [
    "userCode" => "ABCD-EFGH"
    "authorizationCodeVerifier" => "9v3tzb6uovoexps42o22cqkqtqs7v040lj30zt10efhru80ayr1y533yge8mj9i0r479lshtjaq1lmjmlgxwzhfeh5fgxzl5s00"
    "verificationUrl" => "https://portal.ifood.com.br/apps/code"
    "verificationUrlComplete" => "https://portal.ifood.com.br/apps/code?c=NFXD-RWZN"
    "expiresIn" => 600
  ]
]
```

### Requests new access token for accessing our API resources. By default, the token expires in 6 hours.

```php
$response = LaraiFood::auth()->getToken([
  'authorizationCode' => 'RTHJ-TBHB', //this code is generated when Partner grants permission to your application
  'authorizationCodeVerifier' => '9v3tzb6uovoexps42o22cqkqtqs7v040lj30zt10efhru80ayr1y533yge8mj9i0r479lshtjaq1lmjmlgxwzhfeh5fgxzl5s00' //this code is received in the method getUserCode
]);
```

> Example of response
```php
[
  "code" => 200
  "response" => [
    {
      "accessToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzUxMiJ9.eyJzdWIiOiJlNjkwYjczZC01OTI4LTRkMTctODE2ZC01Y2Y5YjgyZTJhOWUiLCJhdWQiOiJvcmRlciIsInVzZXJfbmFtZSI6ImU2OTBiNzNkLTU5MjgtNGQxNy04MTZkLTVjZjliODJlMmE5ZSIsInNjb3BlIjpbIm9yZGVyIl0sInRlbmFudElkIjoiNmFjNjkxZDEtMjZjNi00ZmVkLWJmN2ItOTEwMzJkNTM4NWZkIiwiaXNzIjoiaUZvb2QiLCJtZXJjaGFudF9zY29wZSI6WyI2YjQ4N2EyNy1jNGZjLTRmMjYtYjA1ZS0zOTY3YzIzMzE4ODI6b3JkZXIiXSwiZXhwIjoxNjEyMjMwNDU5LCJpYXQiOjE2MTIyMDg4NTksIm1lcmNoYW50X3Njb3BlZCI6dHJ1ZSwiY2xpZW50X2lkIjoiZTY5MGI3M2QtNTkyOC00ZDE3LTgxNmQtNWNmOWI4MmUyYTllIiwiYXV0aG9yaXRpZXMiOlsiUk9MRV9DTElFTlQiXX0.lYqdxjHoOksq8COqJ-VZxzd524MhVzH7hkMfp5zGTpqzp26z5XJwOPHAy7L6oyagUgRfxntKeu0Up_JHgJ-Vr0h5Y9wY4XHcK1yxpFXFB5f5ilGDB0hVN3UGa4GBqeVpCbAPQUl4VhbF2byeL9PuO4TfTZmoWyuec9-xEH_nbHg",
      "type": "bearer",
      "expiresIn": 21600
    }
  ]
]
```
## Merchant
The Merchant API provides means to interact with merchants on the platform. It is separated into three core parts. Merchant, Status and Interruption, which are described in further detail hereafter. All endpoints require authentication.

### Get all merchants
Lists the summary of all merchants related to the client in the token.
```php
$accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzUxMiJ9.eyJzdWIiOiI4OGUyMzJjMi02OWQ4LTQwMGMtYjI4ZS0yZWU4Yzc0ZjUzMzIiLCJhcHBfbmFtZSI6ImRmYjk1ZjBmLThmZWItNGRhMi1iYTVlLWI4ZDI3MTlmMzFkYyIsImF1ZCI6WyJjYXRhbG9nIiwiZmluYW5jaWFsIiwicmV2aWV3IiwibWVyY2hhbnQiLCJvcmRlciIsIm9hdXRoLXNlcnZlciJdLCJvd25lcl9uYW1lIjoiIiwic2NvcGUiOlsiY2F0YWxvZyIsInJldmlldyIsIm1lcmNoYW50Iiwib3JkZXIiLCJjb25jaWxpYXRvciJdLCJpc3MiOiJpRm9vZCIsInR5cGUiOiJjb21wYWN0IiwiZXhwIjoxNjI5MTc4NDkwLCJpYXQiOjE2MjkxNTY4OTAsImp0aSI6IjI5NGRlNTE0LWM3MTQtNDY4YS1hOWNlLWYyZjM2ZGFhZjhiMiIsIm1lcmNoYW50X3Njb3BlZCI6dHJ1ZSwiY2xpZW50X2lkIjoiZGZiOTVmMGYtOGZlYi00ZGEyLWJhNWUtYjhkMjcxOWYzMWRjIn0.Y1gu30zk7vDXAWtIGJR7DnFAwEFL63rUH9DddQp-au_1OVY0yPHC92bI4lRLc8nfLiUT2drx2KFB2X0M1DCRVMA9RX4_5GFUy1bRXJiBttAsM5-C3egZMRYG5cVpDYXs8NZORLIPZVMcACAJ_1DOHabBpIyabkimMxIj8pXUG0E';
$merchantId = '75f3535e-af3e-4034-b748-908f587e45c4';

$response = LaraiFood::merchant($accessToken)->getAllMerchants();
```
> Example of response
```php
[
  "code" => 200
  "response" => [
    [
      {
        "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
        "name": "string",
        "corporateName": "string"
      }
    ],
    [
      {
        "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
        "name": "string",
        "corporateName": "string"
      }
    ]
  ]
]
```
### Get detailed about the merchant
Gets detailed information about the merchant, such as merchant basic info, address and operations.
```php
$accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzUxMiJ9.eyJzdWIiOiI4OGUyMzJjMi02OWQ4LTQwMGMtYjI4ZS0yZWU4Yzc0ZjUzMzIiLCJhcHBfbmFtZSI6ImRmYjk1ZjBmLThmZWItNGRhMi1iYTVlLWI4ZDI3MTlmMzFkYyIsImF1ZCI6WyJjYXRhbG9nIiwiZmluYW5jaWFsIiwicmV2aWV3IiwibWVyY2hhbnQiLCJvcmRlciIsIm9hdXRoLXNlcnZlciJdLCJvd25lcl9uYW1lIjoiIiwic2NvcGUiOlsiY2F0YWxvZyIsInJldmlldyIsIm1lcmNoYW50Iiwib3JkZXIiLCJjb25jaWxpYXRvciJdLCJpc3MiOiJpRm9vZCIsInR5cGUiOiJjb21wYWN0IiwiZXhwIjoxNjI5MTc4NDkwLCJpYXQiOjE2MjkxNTY4OTAsImp0aSI6IjI5NGRlNTE0LWM3MTQtNDY4YS1hOWNlLWYyZjM2ZGFhZjhiMiIsIm1lcmNoYW50X3Njb3BlZCI6dHJ1ZSwiY2xpZW50X2lkIjoiZGZiOTVmMGYtOGZlYi00ZGEyLWJhNWUtYjhkMjcxOWYzMWRjIn0.Y1gu30zk7vDXAWtIGJR7DnFAwEFL63rUH9DddQp-au_1OVY0yPHC92bI4lRLc8nfLiUT2drx2KFB2X0M1DCRVMA9RX4_5GFUy1bRXJiBttAsM5-C3egZMRYG5cVpDYXs8NZORLIPZVMcACAJ_1DOHabBpIyabkimMxIj8pXUG0E';
$merchantId = '75f3535e-af3e-4034-b748-908f587e45c4';

$response = LaraiFood::merchant($accessToken)->getMerchant($merchantId);
```
> Example of response
```php
[
  "code" => 200
  "response" => [
    {
      "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
      "name": "string",
      "corporateName": "string",
      "description": "string",
      "averageTicket": 0,
      "exclusive": true,
      "type": "RESTAURANT",
      "status": "AVAILABLE",
      "createdAt": "2021-08-17T01:25:30.742Z",
      "address": {
        "country": "string",
        "state": "string",
        "city": "string",
        "postalCode": "string",
        "district": "string",
        "street": "string",
        "number": "string",
        "latitude": 0,
        "longitude": 0
      },
      "operations": {
        "name": "delivery",
        "salesChannel": {
          "name": "ifood-app",
          "enabled": "string"
        }
      }
    }
  ]
]
```

## Order
The Order API provides means to interact with orders on the platform. It is separated into three core parts: Events, Details and Actions, which are described in further detail hereafter. All endpoints require authentication.

### Events
Polls events for any orders from merchants associated with the authenticated user.

Each event received from this endpoint must be properly acknowledged, otherwise it will continue to be returned on further requests.
```php
$accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzUxMiJ9.eyJzdWIiOiI4OGUyMzJjMi02OWQ4LTQwMGMtYjI4ZS0yZWU4Yzc0ZjUzMzIiLCJhcHBfbmFtZSI6ImRmYjk1ZjBmLThmZWItNGRhMi1iYTVlLWI4ZDI3MTlmMzFkYyIsImF1ZCI6WyJjYXRhbG9nIiwiZmluYW5jaWFsIiwicmV2aWV3IiwibWVyY2hhbnQiLCJvcmRlciIsIm9hdXRoLXNlcnZlciJdLCJvd25lcl9uYW1lIjoiIiwic2NvcGUiOlsiY2F0YWxvZyIsInJldmlldyIsIm1lcmNoYW50Iiwib3JkZXIiLCJjb25jaWxpYXRvciJdLCJpc3MiOiJpRm9vZCIsInR5cGUiOiJjb21wYWN0IiwiZXhwIjoxNjI5MTc4NDkwLCJpYXQiOjE2MjkxNTY4OTAsImp0aSI6IjI5NGRlNTE0LWM3MTQtNDY4YS1hOWNlLWYyZjM2ZGFhZjhiMiIsIm1lcmNoYW50X3Njb3BlZCI6dHJ1ZSwiY2xpZW50X2lkIjoiZGZiOTVmMGYtOGZlYi00ZGEyLWJhNWUtYjhkMjcxOWYzMWRjIn0.Y1gu30zk7vDXAWtIGJR7DnFAwEFL63rUH9DddQp-au_1OVY0yPHC92bI4lRLc8nfLiUT2drx2KFB2X0M1DCRVMA9RX4_5GFUy1bRXJiBttAsM5-C3egZMRYG5cVpDYXs8NZORLIPZVMcACAJ_1DOHabBpIyabkimMxIj8pXUG0E';

$response = LaraiFood::order($accessToken)->eventsPolling();
```
> Example of response
```php
[
  "code" => 200
  "response" => [
      {
        "createdAt": "2019-09-19T13:40:11.822Z",
        "fullCode": "PLACED",
        "metadata": {
          "additionalProp1": {},
          "additionalProp2": {},
          "additionalProp3": {}
        },
        "code": "PLC",
        "orderId": "07110e1b-8191-4670-baed-407219481ffb",
        "id": "cd40582b-0ef2-4d52-bc7c-507fdff12e21"
      }
  ]
]

```

### Details
Full information on the order (items, payment, delivery information, etc.).
```php
$accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzUxMiJ9.eyJzdWIiOiI4OGUyMzJjMi02OWQ4LTQwMGMtYjI4ZS0yZWU4Yzc0ZjUzMzIiLCJhcHBfbmFtZSI6ImRmYjk1ZjBmLThmZWItNGRhMi1iYTVlLWI4ZDI3MTlmMzFkYyIsImF1ZCI6WyJjYXRhbG9nIiwiZmluYW5jaWFsIiwicmV2aWV3IiwibWVyY2hhbnQiLCJvcmRlciIsIm9hdXRoLXNlcnZlciJdLCJvd25lcl9uYW1lIjoiIiwic2NvcGUiOlsiY2F0YWxvZyIsInJldmlldyIsIm1lcmNoYW50Iiwib3JkZXIiLCJjb25jaWxpYXRvciJdLCJpc3MiOiJpRm9vZCIsInR5cGUiOiJjb21wYWN0IiwiZXhwIjoxNjI5MTc4NDkwLCJpYXQiOjE2MjkxNTY4OTAsImp0aSI6IjI5NGRlNTE0LWM3MTQtNDY4YS1hOWNlLWYyZjM2ZGFhZjhiMiIsIm1lcmNoYW50X3Njb3BlZCI6dHJ1ZSwiY2xpZW50X2lkIjoiZGZiOTVmMGYtOGZlYi00ZGEyLWJhNWUtYjhkMjcxOWYzMWRjIn0.Y1gu30zk7vDXAWtIGJR7DnFAwEFL63rUH9DddQp-au_1OVY0yPHC92bI4lRLc8nfLiUT2drx2KFB2X0M1DCRVMA9RX4_5GFUy1bRXJiBttAsM5-C3egZMRYG5cVpDYXs8NZORLIPZVMcACAJ_1DOHabBpIyabkimMxIj8pXUG0E';
$orderId = '3fa85f64-5717-4562-b3fc-2c963f66afa6';
$response = LaraiFood::order($accessToken)->detail($orderId);
```
> Example of response
```php
[
  "code" => 200
  "response" => [
    {
      "benefits": [
        {
          "targetId": "string",
          "sponsorshipValues": [
            {
              "name": "string",
              "value": 0
            }
          ],
          "value": 0,
          "target": "string"
        }
      ],
      "orderType": "DELIVERY",
      "payments": {
        "methods": [
          {
            "wallet": {
              "name": "string"
            },
            "method": "string",
            "prepaid": true,
            "currency": "string",
            "type": "ONLINE",
            "value": 0,
            "cash": {
              "changeFor": 0
            },
            "card": {
              "brand": "string"
            }
          }
        ],
        "pending": 0,
        "prepaid": 0
      },
      "merchant": {
        "name": "string",
        "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6"
      },
      "salesChannel": "string",
      "picking": {
        "picker": "string",
        "replacementOptions": "STORE_CHOOSE_OTHER_ITEMS"
      },
      "orderTiming": "IMMEDIATE",
      "createdAt": "2021-08-17T01:14:22.581Z",
      "total": {
        "benefits": 0,
        "deliveryFee": 0,
        "orderAmount": 0,
        "subTotal": 0,
        "additionalFees": 0
      },
      "preparationStartDateTime": "2021-08-17T01:14:22.581Z",
      "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
      "displayId": "string",
      "items": [
        {
          "unitPrice": 0,
          "quantity": 0,
          "externalCode": "string",
          "totalPrice": 0,
          "index": 0,
          "unit": "string",
          "ean": "string",
          "price": 0,
          "observations": "string",
          "imageUrl": "string",
          "name": "string",
          "options": [
            {
              "unitPrice": 0,
              "unit": "string",
              "ean": "string",
              "quantity": 0,
              "externalCode": "string",
              "price": 0,
              "name": "string",
              "index": 0,
              "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
              "addition": 0
            }
          ],
          "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
          "optionsPrice": 0
        }
      ],
      "customer": {
        "phone": {
          "number": "string",
          "localizer": "string",
          "localizerExpiration": "2021-08-17T01:14:22.581Z"
        },
        "documentNumber": "string",
        "name": "string",
        "ordersCountOnMerchant": 0,
        "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6"
      },
      "extraInfo": "string",
      "additionalFees": [
        {
          "type": "string",
          "value": 0
        }
      ],
      "delivery": {
        "mode": "DEFAULT",
        "deliveredBy": "IFOOD",
        "deliveryAddress": {
          "reference": "string",
          "country": "string",
          "streetName": "string",
          "formattedAddress": "string",
          "streetNumber": "string",
          "city": "string",
          "postalCode": "string",
          "coordinates": {
            "latitude": 0,
            "longitude": 0
          },
          "neighborhood": "string",
          "state": "string",
          "complement": "string"
        },
        "deliveryDateTime": "2021-08-17T01:14:22.581Z"
      },
      "schedule": {
        "deliveryDateTimeStart": "2021-08-17T01:14:22.581Z",
        "deliveryDateTimeEnd": "2021-08-17T01:14:22.581Z"
      },
      "indoor": {
        "mode": "DEFAULT",
        "deliveryDateTime": "2021-08-17T01:14:22.581Z",
        "table": "string"
      },
      "takeout": {
        "mode": "DEFAULT",
        "takeoutDateTime": "2021-08-17T01:14:22.581Z"
      }
    }
  ]
]
```

## Licença

Sinta-se a vontade em nos ajudar. Faça um PR :)

GNU General Public License v3
