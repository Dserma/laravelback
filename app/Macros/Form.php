<?php

// List
Form::macro('list', function($name, $values, $title = null, $current = null)
{
	$i = 0;
	?>
		<div class="list">
			<span><?php echo $title; ?></span>

			<ul>
				<?php foreach($values as $value): ?>
					<?php
						$id = "singlelist-{$i}-{$value->handle}";
						$checked = ($current == $value->handle) ? ' checked="checked"' : null;
					?>
					<li>
						<input type="radio" id="<?php echo $id; ?>" name="<?php echo $name; ?>" 
							value="<?php echo $value->handle; ?>"<?php echo $checked; ?>/>
							
						<label for="<?php echo $id; ?>">
							<?php echo $value->title; ?>
						</label>
					</li>
				<?php $i++; endforeach; ?>
			</ul>
		</div>
	<?php
});

// Categories
Form::macro('categories', function($categories, $related = null)
{
	// Html
	echo '<ul>';

	// Factorial to get recursively the related categories
	$factorial = function($factorial, $category) use ($related)
	{
		// Verify if this category is checked
		$checked = false;
		if(isset($related) && 
			$related->where('category_id', $category->id)->count())
			$checked = true;

		// Html
		echo '<li>';

		// Input field
		echo Form::checkbox('categories[]', $category->id, $checked);

		// Label
		echo Form::label($category->handle, $category->title);

		// Verify if has children categories
		if($category->children->count())
		{
			// Html
			echo '<ul>';

			// Call the factorial for each category
			foreach($category->children as $child)
				$factorial($factorial, $child);

			// Html
			echo '</ul>';
		}

		// Html
		echo '</li>';
	};

	// Call the factorial for each category
	foreach($categories as $category)
		$factorial($factorial, $category);

	// Html
	echo '</ul>';
});

// Collect
Form::macro('collect', function($name, $collect, array $keys, $value = null, $first_as_empty = false, array $attrs = null)
{
	// Keys
	if($keys == null)
		$keys = ['handle', 'title'];

	// List array
	$list = [];

	// Implements a empty item to list
	if($first_as_empty)
		$list[null] = $first_as_empty;

	// Factorial to get recursively the related categories
	$factorial = function($factorial, $item, $dash = null) use ($list, $keys)
	{
		// Add item to list
		$list[$item->{$keys[0]}] = $dash . $item->{$keys[1]};

		// Verify if has children items
		if($item->children->count())
		{
			// Call the factorial for each item
			foreach($item->children as $child)
				$list += $factorial($factorial, $child, $dash . '&#8212; ');
		}

		// Return incremented list
		return $list;
	};

	// Call the factorial for each item
	foreach($collect as $item)
		$list += $factorial($factorial, $item);

	// Select html
	echo Form::select($name, (array)$list, $value, (array)$attrs);
});

/*
 * Phones
 */
Form::macro('phones', function($handle, $phones = null, $parameters = null, $editable = true)
{
	?>
	<div class="phones<?php echo ($editable) ? ' editable' : null; ?>">
		<?php if((array)$phones): ?>
			<?php foreach((array)$phones as $index => $phone): ?>
				<div class="phone">
					<div class="<?php echo ($index == 0) ? 'add' : 'remove'; ?>">
						<?php echo ($index == 0) ? '+' : '-'; ?>
					</div>
					<?php echo Form::text('phones[' . $index . ']', $phone, $parameters); ?>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="phone">
				<div class="add">+</div>
				<?php echo Form::text('phones[0]', null, $parameters); ?>
			</div>
		<?php endif; ?>
	</div>
	<?php
});
