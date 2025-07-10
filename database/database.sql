Table users {
  id integer
  fullname varchar
  email varchar 
  password varchar
  role_id int
  shipping_address_id int 
  phone varchar
  is_active bool(1)
  created_at timestamp
  updated_at timestamp
}
Table roles {
  id int 
  name varchar
  description text 
  created_at timestamp
}
Table categories {
  id integer
  name varchar 
  slug varchar unique
  path varchar(null)
  created_at timestamp
  updated_at timestamp
}

Table products {
  id integer
  name varchar
  slug varchar(null) unique
  description text
  price decimal(10,2)
  sale_price decimal(10,2)
  weight varchar
  unit enum(g, kg, ml, l)
  stock_quantity bigint
  category_id int 
  status bool
  published_at timestamp
  created_at timestamp
  updated_at timestamp
}

Table product_images {
  id int 
  product_id int 
  image_path varchar
  is_primary bool(0)
  created_at timestamp
  updated_at timestamp
}

Table carts {
  id int
  user_id int(null)
  session_id varchar
  created_at timestamp
  updated_at timestamp
}

Table cart_items {
  id int
  cart_id int 
  product_id int 
  quantity int 
  price decimal(10,2)
  created_at timestamp
  updated_at timestamp
}

Table orders {
  id int 
  user_id int 
  total_amount decimal(10,2)
  order_status enum(pending, confirmed, shipped, delivered, canceled)
  shipping_address_id int
  payment_id int(null)
  coupon_id int(null)
  order_note text(null)
  shipping_fee decimal(10,2)
  created_at timestamp
}

Table order_items {
  id int 
  order_id int
  product_id int 
  quantity int 
  price decimal(10,2)
  created_at timestamp
}

Table payments {
  id int
  order_id int 
  payment_method enum(cod, bank_transfer, momo, zalopay)
  payment_status enum(pending, paid, failed)
  transaction_id varchar
  paid_at timestamp
  created_at timestamp
}

Table shipping_addresses {
  id int 
  user_id int 
  fullname varchar
  phone varchar(10)
  address varchar
  ward_code varchar
  district_code varchar
  city_code varchar
  is_default bool
  created_at timestamp
  updated_at timestamp
}

Table coupons {
  id int
  code varchar 
  discount_type enum(fixed,percent)
  discount_value decimal(10,2)
  expired_at timestamp
  usage_limit bigint
  created_at timestamp
  updated_at timestamp
}

Table reviews {
  id int
  user_id int
  product_id int 
  rating range(1,5)
  comment varchar
  is_verfied_purchase bool
  created_at timestamp
}

Table review_images {
  id int 
  review_id int 
  image_path varchar
}

Table inventory_logs {
  id int
  product_id int
  quantity_change int
  stock_after_change bigint
  type enum(import, order, cancel_order, return, manual_adjust)
  reference_type varchar(null)  // eg: 'order', 'admin'
  reference_id int(null)        // liên kết tới order_id hoặc admin_id nếu cần
  note text(null)
  created_at timestamp
}

Table order_status_logs {
  id int
  order_id int
  old_status enum(pending, confirmed, shipped, delivered, canceled)
  new_status enum(pending, confirmed, shipped, delivered, canceled)
  changed_by_type enum(admin, user, system)
  changed_by_id int
  note text(null)
  created_at timestamp
}
Table wishlists {
  id int
  user_id int
  product_id int
  created_at timestamp
}
Table notifications {
  id int
  user_id int (nullable)        // null nếu là global (thông báo chung)
  type enum(order, system, promotion, admin_message)
  title varchar
  content text
  is_read bool(0)
  created_at timestamp
}
Table search_logs {
  id int
  user_id int (nullable)
  keyword varchar
  created_at timestamp
}
Table social_accounts {
  id int
  user_id int
  provider enum(google, facebook, github)
  provider_user_id varchar
  access_token text
  created_at timestamp
}
Table user_activities {
  id int
  user_id int
  action varchar
  ip_address varchar
  user_agent text
  created_at timestamp
}
Table shipping_providers {
  id int
  code varchar unique         
  name varchar                
  description text (nullable) 
  logo varchar (nullable)    
  api_key varchar (nullable)  
  api_url varchar (nullable) 
  webhook_url varchar (nullable) 
  fee_formula text (nullable) 
  is_active bool(1)
  created_at timestamp
  updated_at timestamp
}
