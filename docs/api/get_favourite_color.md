# Get favourite color

Performs a query using an e-mail/password pair sent as form data. If the provided data is correct, the favourite color of the user is returned.

## HTTP Request

```text
POST /api/get_favourite_color
```

## Request body

In the request body, provide the following parameters (form-data):

| Parameter | Type   | Description |
|:----------|:-------|:------------|
| email     | string | E-mail      |
| password  | string | Password    |

## Response

If the provided data is correct, this method returns a response body with the following structure:

```text
{
  "color": string
}
```

| Property name | Value  | Description                                          |
|:--------------|:-------|:-----------------------------------------------------|
| color         | string | "red", "green", "yellow", "blue", "black" or "white" |

If the provided e-mail/password pair does not match, the following structure is returned:

```text
{
  "error_code": integer
}
```

| Property name | Value   | Description                         |
|:--------------|:--------|:------------------------------------|
| error_code    | integer | See the table below for the details |

| Error code | Description                |
|:-----------|:---------------------------|
| 0          | Internal error             |
| 1          | Invalid request parameters |
| 2          | Invalid e-mail address     |
| 3          | Invalid password           |
