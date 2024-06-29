<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $thumb_images
 * @property string|null $note
 * @property string|null $gallery
 * @property string $descriptions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ActivitiesFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Activities newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activities newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activities query()
 * @method static \Illuminate\Database\Eloquent\Builder|Activities whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activities whereDescriptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activities whereGallery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activities whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activities whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activities whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activities whereThumbImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activities whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activities whereUpdatedAt($value)
 */
	class Activities extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $qunt
 * @property int $price
 * @property int $option_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereQunt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereUserId($value)
 */
	class Cart extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $thumb_image
 * @property string $images
 * @property string $tags
 * @property string $old_price
 * @property string|null $offer
 * @property int $status
 * @property int $quantity
 * @property int $category_id
 * @property int $sub_category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Variation> $variations
 * @property-read int|null $variations_count
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOffer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSubCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereThumbImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property string|null $image
 * @property string|null $background_image
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereBackgroundImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereUpdatedAt($value)
 */
	class ProductCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $product_id
 * @property int $variation_option_id
 * @property string $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariationOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariationOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariationOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariationOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariationOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariationOption wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariationOption whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariationOption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariationOption whereVariationOptionId($value)
 */
	class ProductVariationOption extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $product_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VariationOption> $options
 * @property-read int|null $options_count
 * @method static \Illuminate\Database\Eloquent\Builder|Variation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Variation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Variation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereUpdatedAt($value)
 */
	class Variation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $variation_id
 * @property string $name
 * @property string $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VariationOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariationOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariationOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|VariationOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationOption whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationOption wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationOption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariationOption whereVariationId($value)
 */
	class VariationOption extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $upazila
 * @property string $city
 * @property string $address
 * @property string $phone
 * @property string|null $message
 * @property int $user_id
 * @property string $status
 * @property string $total
 * @property string $discount
 * @property string $shipping
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|order query()
 * @method static \Illuminate\Database\Eloquent\Builder|order whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order whereShipping($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order whereUpazila($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order whereUserId($value)
 */
	class order extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $quantity
 * @property string $price
 * @property string $sub_total
 * @property string|null $others
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|order_item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|order_item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|order_item query()
 * @method static \Illuminate\Database\Eloquent\Builder|order_item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order_item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order_item whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order_item whereOthers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order_item wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order_item whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order_item whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order_item whereSubTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|order_item whereUpdatedAt($value)
 */
	class order_item extends \Eloquent {}
}

