# This ```packages``` folder for manually downloaded packages

> add this in your ```composer.json```

```
"autoload": {
        "classmap": [
            "packages" // this line should be added
        ]
    },
```

> put every package folder here and then use ```composer dump-autoload``` command