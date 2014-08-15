codeigniter-rediscache
======================
A CodeIgniter library for a simple cache system using redis.
Please feel free to let me know (or just fork) if you find any bugs or improvements points.

Thanks, -ashiina (https://github.com/ashiina)

Requirements
-----------
1. PHP 5.0 or more
2. CodeIgniter 2.0 or more (http://codeigniter.com)
3. CodeIgniter Redis Library (https://github.com/joelcox/codeigniter-redis)

Guide
-----------
### Installing the Redis Library
The Redis library is required for Rediscache to work,
so please install the Redis library first (if you have not done so yet).
Instructions can be found below:

https://github.com/ashiina/codeigniter-redis

### Commands
Set cache :
You can set a cache simply of a value, with an expiration time.

The types of values you can set for a cache are congruent to the 
types of values allowed for the serialize() method.
Please refer to the official documentation (http://jp2.php.net/manual/ja/function.serialize.php)
for the types of values allowed.
```
     $this->credis->set('rediscache.test.key1', array('hoge' => 'fuga'), 500);
```

Get cache :
You can get the value of a cache simply with the get function.
```
     $val = $this->credis->get('rediscache.test.key1');
```

Get keys cache :
You can get the keys of a cache simply with the get function.
```
     $val = $this->credis->getKeys();
```

Delete cache :
Deleting a cache is also as simple.
```
     $this->credis->del('rediscache.test.key1');
```

License
----------
This library is released under the MIT license.



