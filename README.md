# Sorted list

The package provides sorted list class with methods to work with sorted list.

# How to install

Add the package

```
composer require dmashkin/sorted-list
```

# How to use

Create a class `SortedList`

```
use SortedList\SortedList;

$sortedList = new SortedList();
```

# Methods

1. Add new value to sorted list

```
$sortedList->put($value);
```

2. Get sorted list

```
$sortedList->get();
```

3. Check if value exists in sorted list

```
$sortedList->exists($value);
```

4. Get leftmost position of new value

```
$sortedList->leftPosition($value);
```

5. Get rightmost position of new value

```
$sortedList->rightPosition($value);
```

6. Get minimum and maximum value respectively

```
$sortedList->getMin();
$sortedList->getMax();
```

7. Extract minimum and maximum value respectively

```
$sortedList->popMin();
$sortedList->popMax();
```

# Unit tests

1. Install unit test package

```
composer install --dev
```

2. Run unit tests

```
./vendor/bin/phpunit
```