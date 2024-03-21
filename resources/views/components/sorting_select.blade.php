<select name="sort_type">
  <option value="newest" {{ $sortType === 'newest' ? 'selected' : '' }}>新しい順</option>
  <option value="oldest" {{ $sortType === 'oldest' ? 'selected' : '' }}>古い順</option>
  <option value="most_viewed" {{ $sortType === 'most_viewed' ? 'selected' : '' }}>閲覧数順</option>
  <option value="best" {{ $sortType === 'best' ? 'selected' : '' }}>いいね順</option>
</select>