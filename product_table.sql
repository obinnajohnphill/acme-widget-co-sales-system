--
-- Table structure for table `product_table`
--
CREATE TABLE `product_table` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_table`
--
INSERT INTO `product_table` (`id`, `name`, `code`, `image`, `price`) VALUES
(1, 'Red Widget', 'RO1', 'product-images/red.jpg', 32.95),
(2, 'Green Widget', 'GO1', 'product-images/green.jpg', 24.95),
(3, 'Blue Widget', 'BO1', 'product-images/blue.jpg', 7.95);


--
-- Indexes for table `product_table`
--
ALTER TABLE `product_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`code`);


--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;