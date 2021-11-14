<?php if (isset($type) && $type): ?>
<?php for ($i = 0; $i < $type; $i++): ?>
<div class="col-lg-6 form-group">
	<div class="row">
		<div class="col-lg-4">
			<label class="control-label" for="product">Sản phẩm<span style="color: red;">(*)</span>:</label>
		</div>
		<div class="col-lg-8">
			<select class="form-control" data-live-search="true" data-size="15" name="product<?php echo $i; ?>" id="product">
				<option value="-1">- Sản phẩm -</option>
				<?php if(isset($product) && $product):?>
					<?php foreach ($product as $result_product):?>
						<option value="<?php echo $result_product['id']; ?>"><?php echo $result_product['name']; ?></option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
			<?php echo form_error('product'); ?>
		</div>
	</div>
</div>
<div class="col-lg-6 form-group" style="margin-left: 10px;">
	<div class="row">
		<div class="col-lg-4">
			<label class="control-label" for="import_quantity">Số lượng<span style="color: red;">(*)</span>:</label>
		</div>
		<div class="col-lg-8">
			<input type="text" class="form-control" id="import_quantity" name="import_quantity<?php echo $i; ?>" value="<?php echo set_value('import_quantity'); ?>">
			<?php echo form_error('import_quantity'); ?>
		</div>
	</div>
</div>
<?php endfor; ?>
<?php endif; ?>
