# Doctrine helper - creating entity

```php
/**
 * @ORM\Id()
 * @ORM\GeneratedValue()
 * @ORM\Column(type="integer")
 */
private $id;
```
```php
/**
 * @ORM\Column(type="string", length=255)
 */
private $title;
```
```php
/** @Column(type="integer") */
private $id;
```

```php
/**
 * @ORM\Column(type="text", nullable=true)
 */
private $content;
```
```php
/**
 * @ORM\Column(type="datetime", nullable=true)
 */
private $publishedAt;
```
```php
/**
 * @ManyToOne(targetEntity="Address")
 * @JoinColumn(name="address_id", referencedColumnName="id")
 */
private $address;
```
